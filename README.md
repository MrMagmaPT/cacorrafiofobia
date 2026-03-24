# How to set up the project:
#### get ot project directory:
```bash
cd /var/www/html/cacorrafiofobia
```


# Win 11 env:
```powershell
cd C:\wamp64\www\cacorrafiofobia
``` 
### If .env doesn't exist, create it from example (if example exists)
```powershell
Copy-Item .env.example .env -ErrorAction SilentlyContinue
``` 
### Install dependencies
```powershell
composer install
``` 
### Generate app key
```powershell
php artisan key:generate

php artisan migrate

php artisan migrate:status
``` 

### SQL bootstrap + RPG schema (dev)
Run this if you also want the RPG SQL tables in local dev.

```powershell
# Creates DB/user/privileges from deployment/db-init.sql defaults
mysql -u root -p < deployment\db-init.sql

# Runs Laravel migrations (users, sessions, jobs, etc.)
php artisan migrate

# Creates RPG tables (player_characters, player_races, player_classes, etc.)
mysql -u root -p cacorrafiofobia < deployment\db-schema.sql
```

# Ubuntu Cli Server:
```powershell
cd /var/www/cacorrafiofobia
```

### If .env missing:
```powershell
cp .env.example .env 
``` 

### Install production deps
```powershell
composer install --no-dev --optimize-autoloader
```

## App key
```powershell
php artisan key:generate

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache 
```

### SQL bootstrap + RPG schema (server)
```bash
# Creates DB/user/privileges from deployment/db-init.sql defaults
mysql -u root -p < deployment/db-init.sql

# Runs Laravel migrations in production mode
php artisan migrate --force

# Creates RPG tables (player_characters, player_races, player_classes, etc.)
mysql -u root -p cacorrafiofobia < deployment/db-schema.sql
```




# Migration command cheat sheet (works for both)
```powershell
php artisan migrate                    # run pending migrations
php artisan migrate:status             # show applied/pending
php artisan migrate:rollback           # rollback last batch
php artisan migrate:rollback --step=1  # rollback one migration step
php artisan migrate:refresh            # rollback all + rerun all
php artisan migrate:fresh              # drop all tables + rerun (data loss)
php artisan db:seed                    # run seeders
php artisan migrate --seed             # migrate then seed
``` 

Important: `deployment/db-schema.sql` depends on Laravel `users` table, so run it after `php artisan migrate`.

# If migration fails
```powershell
php artisan config:clear
php artisan cache:clear
php artisan migrate
```


# SQL
```sql
character_profile: 
id: (int primary-key) 
age: (int) 
name: (string 200 char) 
race_id: (forign key that links to race table) 
SubRace_id: (forign key that links to race table (can be null)) 
class_id: (foreign key that links to class table) 
subclass_id: (foreign key that links to class table (can be null)) 
LVL: (int)
aligment: (String)
money: (float) 
hp: (float)
stats_id: (foreign key for stats table)

stats:
id: (int)
mana: (float)
defence: (float)
magic: (float)
Int: (int)
Ma: (int)
Uc: (int)
Lu: (int)
Com: (int)
Agi: (int)
Str: (int)
Md: (int)
Con: (int)
Res: (int)

race: 
id: (primary key) 
Name: (string)

class: 
id: (prinary key) 
Name: (string)

item: 
id: (primary key)
user_id: (foreign for user) 
type: (enum) 
Tier: (int)
Price: (float)
Size: (float) 
Image: (either url or blob idk) 
Name: (String)
Desc: (Sting)
bonus: (float)

skill: 
id: (primary key) 
user_id: (foreign key for user)
name: (string)
desc: (string)
bonus: (float) 
type: (enum)
mana_cost: (int) 
hp_cost: (int) 
bonus_on_stat: (enum for 10 "items")

magic: 
id: (primary key) 
user_id: (foreign key for user)
magiccircles_id: (foreign key for magic_circles)
lvl: (int)
mana_cost: (float)
Tier: (int)
Name: (string)
Effect: (string 500+ chars)
Description: (string)
```

#### Running migrations if they fail due to caching issues
```cmd
php artisan migrate
```
