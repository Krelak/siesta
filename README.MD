# Install dependencies for the project
- Composer install

# Create database structure
- php artisan migrate

# Insert films to vote
- php artisan insert:films https://sitgesfilmfestival.com/cas/programa/pel_licules

# Access online form starting with the last film you have voted
- http://devel-siesta.com/movie/1