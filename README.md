# Trains
Train sample app

1. First, make a copy of the _.env.example_ file and add your database credentials.

2. Install dependencies by running `composer install`.

3. After installation, run `php artisan migrate` to set up the database.

4. From there, set up your Virtual Hosts to point to the _/public_ folder. Ex: `/var/www/html/trains/public`

5. Webpage should be good to go.

See the Lumen installation documentation for more details: https://lumen.laravel.com/docs/7.x/installation


---------------
## Notes

* Sorting is (acending) is enabled.
* Entries can be deleted using a deletion link.
* CSVs handle the creation and updating of entries. Entries use the Run Number as the primary identifier, assuming that there'll only be no duplicate Run Numbers within a Train Line.
