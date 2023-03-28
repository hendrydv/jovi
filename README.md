<p align="center"><a href="https://jovi.biz/" target="_blank"><img src="./resources/images/jovi.png" width="400" alt="Laravel Logo"></a></p>

# Jovi inspectiesysteem

Gebasseerd op het Back-end framework Laravel en werkt met het admin panel Filament.

## Commands

### Eerste keer
- `Composer install` Alle composer packages installeren
- `npm install` Alle NPM packages installeren
- `php artisan make:filament-user` Filament gebruiker aanmaken
- `php artisan migrate` Migrations uitvoeren
- `php artisan key:generate` App key genereren

### Elke keer bij opstarten
- `php artisan serve` = Laravel start development server
- `npm run dev` = Vite build assets

### Laravel models
- `php artisan make:model ModelNaam --migration` Eqoulent model maken met de migration

### Filament admin panel
- `php artisan make:filament-resource ModelNaam --generate` Filament resouerce maken met alle tabel en form velden
- `php artisan make:filament-relation-manager ModelNaamResource tabel_waarop tekst_veld` Filament relatie maken van model met een tabel