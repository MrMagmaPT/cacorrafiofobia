#!/bin/bash
# ============================================================
# Cacorrafiofobia — LAMP Deployment Script
# Run this on the Linux server after uploading the project
# Usage: bash deployment/deploy.sh
# ============================================================

set -e  # Exit immediately on error

APP_DIR="/var/www/cacorrafiofobia"
WEB_USER="www-data"  # Apache user on Debian/Ubuntu (use 'apache' on RHEL/CentOS)

echo "==> Moving to app directory..."
cd "$APP_DIR"

echo "==> Installing PHP dependencies (no dev)..."
composer install --no-dev --optimize-autoloader

echo "==> Copying .env if it doesn't exist..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "    !! .env created from .env.example — edit it before continuing !!"
    echo "    Fill in DB_PASSWORD, APP_KEY, APP_URL then re-run this script."
    exit 1
fi

echo "==> Generating app key (skipped if already set)..."
php artisan key:generate --no-interaction --force

echo "==> Setting file permissions..."
chown -R "$WEB_USER":"$WEB_USER" "$APP_DIR"
chmod -R 755 "$APP_DIR"
chmod -R 775 "$APP_DIR/storage"
chmod -R 775 "$APP_DIR/bootstrap/cache"

echo "==> [1/3] Creating MariaDB database and user..."
# Edit these values to match your .env
DB_NAME="cacorrafiofobia"
DB_USER="cacorrafiofobia_user"
DB_PASS="your_strong_password_here"   # <-- change this

DB_NAME_SQL=${DB_NAME//\'/\'\'}
DB_USER_SQL=${DB_USER//\'/\'\'}
DB_PASS_SQL=${DB_PASS//\'/\'\'}
DB_BOOTSTRAP_FILE="/tmp/cacorrafiofobia-db-bootstrap.sql"

cat > "$DB_BOOTSTRAP_FILE" <<EOF
SET @DB_NAME = '$DB_NAME_SQL';
SET @DB_USER = '$DB_USER_SQL';
SET @DB_PASS = '$DB_PASS_SQL';
SOURCE $APP_DIR/deployment/db-init.sql;
EOF

mysql -u root -p < "$DB_BOOTSTRAP_FILE"
rm -f "$DB_BOOTSTRAP_FILE"

echo "==> [2/3] Running Laravel migrations (creates users table and other core tables)..."
php artisan migrate --force

echo "==> [3/3] Running RPG schema (requires Laravel users table to exist)..."
DB_SCHEMA_FILE="/tmp/cacorrafiofobia-db-schema.sql"

cat > "$DB_SCHEMA_FILE" <<EOF
SET @DB_NAME = '$DB_NAME_SQL';
SOURCE $APP_DIR/deployment/db-schema.sql;
EOF

mysql -u root -p < "$DB_SCHEMA_FILE"
rm -f "$DB_SCHEMA_FILE"

echo "==> Caching config, routes and views for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Enabling Apache mod_rewrite (if not already enabled)..."
a2enmod rewrite

echo "==> Copying VirtualHost config..."
cp "$APP_DIR/deployment/apache-vhost.conf" /etc/apache2/sites-available/cacorrafiofobia.conf
a2ensite cacorrafiofobia.conf
a2dissite 000-default.conf  # disable default site (optional)
systemctl reload apache2

echo ""
echo "========================================="
echo " Deploy complete! App is live."
echo "========================================="

