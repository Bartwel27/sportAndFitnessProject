# Setup (do these once, in order)

1. Unzip this folder into your Laravel project (sportAndFitnessProject). Accept file replacements.
2. app/Models/User.php
   - add 'role' to $fillable:   protected $fillable = ['name','email','password','role'];
   - add this method inside the class:
       public function orders() { return $this->hasMany(\App\Models\Order::class); }
3. bootstrap/app.php, inside ->withMiddleware(function (Middleware $middleware) { ... }):
       $middleware->alias(['admin' => \App\Http\Middleware\AdminMiddleware::class]);
4. Run, one at a time:
       php artisan migrate
       php artisan db:seed
       php artisan storage:link        (needed so uploaded product images show)
       php artisan route:clear
       php artisan view:clear
       npm run build
5. Admin login: admin@bartwel.com / password
