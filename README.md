# Shozy App - Laravel Backend with Admin Panel

A Laravel application with three user roles (Customer, Technician, Delivery) and an admin panel, designed for mobile app backend services.

## Features

- **User Management**: Three distinct user roles with Spatie Laravel Permission
- **API Authentication**: Laravel Sanctum for mobile app authentication
- **Admin Panel**: Secure admin dashboard with user statistics
- **Role-based Access Control**: Granular permissions for different user types

## User Roles

1. **Customer**: Can create orders, view their orders, and track delivery
2. **Technician**: Can view orders, update order status, and view delivery information
3. **Delivery**: Can view orders, update order status, and track delivery

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure database
4. Generate application key: `php artisan key:generate`
5. Run migrations and seeders: `php artisan migrate:fresh --seed`
6. Start the server: `php artisan serve`

## Database Setup

The application uses MySQL with the following configuration:
- Database name: `shozy_app`
- Character set: `utf8mb4`
- Collation: `utf8mb4_unicode_ci`

## Default Admin Account

- **Email**: admin@shozy.com
- **Password**: password123

## API Endpoints

### Authentication (Mobile App)

- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout (requires authentication)
- `GET /api/user` - Get authenticated user info

### Admin Panel

- `GET /admin/login` - Admin login form
- `POST /admin/login` - Admin login
- `GET /admin/dashboard` - Admin dashboard (requires authentication)
- `POST /admin/logout` - Admin logout

## API Usage Examples

### User Registration
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "customer"
  }'
```

### User Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Authenticated Request
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer {your_token}"
```

## Admin Panel Access

1. Navigate to `http://localhost:8000/admin/login`
2. Use the default admin credentials:
   - Email: admin@shozy.com
   - Password: password123
3. Access the dashboard at `http://localhost:8000/admin/dashboard`

## File Structure

```
app/
├── Http/Controllers/
│   ├── Api/AuthController.php      # Mobile app authentication
│   └── Admin/                      # Admin panel controllers
│       ├── AuthController.php      # Admin authentication
│       └── DashboardController.php # Admin dashboard
├── Models/
│   ├── User.php                    # User model with roles
│   └── Admin.php                   # Admin model
└── Providers/
    └── AppServiceProvider.php      # Database configuration

database/
├── migrations/                      # Database migrations
└── seeders/                        # Database seeders
    ├── RolePermissionSeeder.php    # Roles and permissions
    └── AdminSeeder.php             # Default admin user

resources/views/admin/               # Admin panel views
├── auth/login.blade.php            # Admin login form
└── dashboard.blade.php             # Admin dashboard

routes/
├── api.php                         # Mobile app API routes
└── web.php                         # Admin panel routes
```

## Security Features

- **CSRF Protection**: Enabled for web routes
- **API Token Authentication**: Laravel Sanctum for mobile app
- **Session Authentication**: For admin panel
- **Role-based Access Control**: Spatie Laravel Permission
- **Password Hashing**: Secure password storage

## Development

- **PHP Version**: 8.1+
- **Laravel Version**: 10.x
- **Database**: MySQL 8.0+
- **Key Packages**: 
  - Laravel Sanctum (API authentication)
  - Spatie Laravel Permission (Roles & Permissions)

## Testing the System

1. **Start the server**: `php artisan serve`
2. **Test Admin Panel**: Visit `http://localhost:8000/admin/login`
3. **Test API**: Use tools like Postman or curl to test API endpoints
4. **Create Test Users**: Use the registration API to create users with different roles

## Troubleshooting

### Database Connection Issues
- Ensure MySQL service is running
- Check database credentials in `.env` file
- Verify database `shozy_app` exists

### Migration Issues
- If you encounter key length errors, the AppServiceProvider is already configured to handle this
- Ensure MySQL version supports utf8mb4 character set

### Permission Issues
- Clear config cache: `php artisan config:clear`
- Clear application cache: `php artisan cache:clear`

## Next Steps

- Implement order management system
- Add user profile management
- Create notification system
- Implement real-time updates
- Add file upload functionality
- Create comprehensive API documentation
