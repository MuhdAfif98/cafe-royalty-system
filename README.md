# Coffee Shop Loyalty PWA

A Progressive Web App (PWA) for a coffee shop loyalty program that allows customers to earn and redeem points for purchases. Built with Laravel, Livewire, and Tailwind CSS.

## Features

### 🎯 Core Functionality
- **Points System**: Earn 1 point per $1 spent (rounded down)
- **QR Code Integration**: Scan QR codes for instant point earning
- **Redemption System**: Redeem 10 points for $1 discount
- **Phone Verification**: OTP-based phone number verification
- **Offline Support**: Works offline with data sync when connected

### 📱 PWA Features
- **Installable**: Add to home screen on mobile devices
- **Offline First**: Caches data and works without internet
- **Push Notifications**: Get notified about points and rewards
- **Responsive Design**: Optimized for mobile devices

### 🔐 Security Features
- **Laravel Sanctum**: API authentication
- **Rate Limiting**: Prevents abuse
- **QR Code Signing**: Cryptographic signatures for QR codes
- **Input Validation**: Comprehensive validation and sanitization

## System Architecture

### Database Schema
- **Users**: Customer accounts with phone numbers and points balance
- **Points Transactions**: Track all points earned and redeemed
- **Redemptions**: Store redemption records with QR codes
- **QR Codes**: Generated QR codes for purchases and redemptions
- **OTP Codes**: Phone verification and password reset codes

### Workflows

#### Customer Scans Staff QR Code
1. Staff generates QR code with purchase amount
2. Customer scans QR code in PWA
3. Points awarded instantly after validation
4. Transaction logged with cryptographic signature

#### Staff Scans Customer QR Code
1. Customer shows QR code in PWA
2. Staff scans customer's QR code
3. Staff enters purchase amount
4. Points awarded to customer account

#### Redemption Process
1. Customer selects reward in PWA
2. Points deducted from balance
3. Redemption QR code generated
4. Staff scans redemption QR code during checkout
5. Discount applied to purchase

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (or MySQL/PostgreSQL)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd cafe-royalty-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   ```bash
   # For SQLite (default)
   touch database/database.sqlite
   
   # Or update .env for MySQL/PostgreSQL
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database with sample data**
   ```bash
   php artisan db:seed --class=LoyaltySeeder
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

### Environment Variables

Add these to your `.env` file:

```env
# Twilio Configuration (for SMS)
TWILIO_SID=your_twilio_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_FROM_NUMBER=your_twilio_phone_number

# App Configuration
APP_NAME="Coffee Shop Loyalty"
APP_URL=http://localhost:8000

# Database (SQLite by default)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

## Usage

### Test Accounts

**Customer Account:**
- **Email**: john@example.com
- **Password**: Password123!
- **Phone**: +1234567890

**Staff Account:**
- **Email**: staff@cafe.com
- **Password**: staff123
- **Phone**: +1234567892

### Customer Workflow

1. **Register/Login**: Use phone number and password
2. **Verify Phone**: Receive OTP via SMS
3. **Earn Points**: 
   - Scan staff QR codes
   - Enter purchases manually (pending approval)
4. **Redeem Points**: Convert points to discounts
5. **Track Activity**: View transaction history

### Staff Workflow

1. **Access Staff Dashboard**: Visit `/staff/login` or login as staff user
2. **Scan Customer QR Codes**: Use QR scanner to scan customer QR codes
3. **Process Purchases**: Enter purchase amount and award points
4. **Process Redemptions**: Scan redemption QR codes during checkout
5. **Manual Entry**: Add points manually for customers
6. **View Activity**: Monitor recent transactions and pending redemptions

### Staff Access
- **Direct URL**: `http://localhost:8000/staff/login`
- **From Customer App**: Staff users see "Staff" tab in bottom navigation
- **QR Scanner**: Built-in camera scanner for customer and redemption QR codes

## API Endpoints

### Customer Endpoints
- `GET /api/points/summary` - Get points summary
- `POST /api/purchase/qr` - Process QR code purchase
- `POST /api/purchase/manual` - Submit manual purchase
- `POST /api/points/redeem` - Redeem points
- `GET /api/transactions` - Get transaction history
- `GET /api/redemptions` - Get redemption history

### Staff Endpoints
- `POST /api/staff/qr/purchase` - Generate purchase QR code
- `POST /api/staff/qr/user` - Process user QR code
- `POST /api/staff/qr/redemption` - Process redemption QR code

## PWA Features

### Service Worker
- Caches static assets
- Enables offline functionality
- Handles background sync
- Manages push notifications

### Manifest
- App name and description
- Icons for different sizes
- Theme colors
- Display mode (standalone)

### Offline Support
- Caches dashboard and profile data
- Queues offline transactions
- Syncs when connection restored
- Shows offline status

## Security Considerations

### QR Code Security
- Cryptographic signatures prevent tampering
- 5-minute expiration for purchase QR codes
- 24-hour expiration for redemption QR codes
- One-time use only

### Rate Limiting
- 100 requests per hour per IP
- Daily point earning limit (100 points)
- OTP rate limiting

### Data Protection
- HTTPS required for production
- Input sanitization
- SQL injection prevention
- XSS protection

## Development

### Adding New Features
1. Create migrations for database changes
2. Update models with relationships
3. Add Livewire components for UI
4. Create API endpoints if needed
5. Update service worker for caching

### Testing
```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=DashboardTest
```

### Code Style
```bash
# Format code
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

## Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Configure HTTPS
- [ ] Set up Twilio credentials
- [ ] Configure database
- [ ] Set up queue worker
- [ ] Configure caching
- [ ] Set up monitoring

### Queue Jobs
```bash
# Start queue worker
php artisan queue:work

# Process failed jobs
php artisan queue:retry all
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support, please open an issue on GitHub or contact the development team. 
