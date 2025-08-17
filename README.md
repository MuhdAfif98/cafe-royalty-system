# ☕ Sip n Save - Coffee Shop Loyalty PWA

> **Your daily coffee ritual just got more rewarding!** 🎉

A delightful Progressive Web App that turns every coffee purchase into a journey of rewards. Built with love using Laravel, Livewire, and Tailwind CSS - because great coffee deserves great technology! 

## 🌟 What's Brewing?

### ✨ Core Features
- **🎯 Smart Points System**: Earn 1 point per $1 spent (because every sip counts!)
- **📱 QR Magic**: Scan & earn points instantly - no more fumbling with cards!
- **🎁 Rewards Galore**: Redeem 10 points for $1 off (your wallet will thank you)
- **📞 Phone Verification**: Secure OTP-based verification (keeping it safe & simple)
- **🔄 Offline Superpowers**: Works even when your WiFi is having a coffee break

### 🚀 PWA Awesomeness
- **📲 Installable**: Add to home screen like a real app (because it IS a real app!)
- **🌐 Offline First**: No internet? No problem! Your points are safe
- **🔔 Smart Notifications**: Get pinged about your coffee rewards
- **📱 Mobile Perfect**: Designed for your phone (where the coffee magic happens)

## 🏗️ Behind the Scenes

### 🗄️ Database Magic
- **👥 Users**: Your coffee-loving customers with points & phone numbers
- **💰 Points Transactions**: Every coffee adventure tracked
- **🎫 Redemptions**: Your reward redemption stories
- **📱 QR Codes**: The magic tickets to coffee rewards
- **🔐 OTP Codes**: Keeping everything secure & verified

### 🎬 How the Magic Happens

#### Customer Scans Staff QR Code 🎯
1. Staff whips up a QR code with your purchase amount
2. You scan it with your phone (like a coffee ninja!)
3. Points appear instantly (magic!)
4. Everything gets logged securely (because we're responsible like that)

#### Staff Scans Customer QR Code 👨‍💼
1. You show your QR code (like a VIP pass!)
2. Staff scans it with their device
3. Purchase amount gets entered
4. Points flow into your account (cha-ching!)

#### Redemption Adventure 🎁
1. You pick your reward in the app
2. Points get deducted (but don't worry, you earned them!)
3. A redemption QR code appears
4. Staff scans it during checkout
5. Discount applied (your wallet breathes a sigh of relief!)

## 🚀 Let's Get This Coffee Party Started!

### 📋 What You'll Need
- PHP 8.2+ (the freshest brew)
- Composer (your package manager)
- Node.js & npm (for the frontend magic)
- SQLite (or MySQL/PostgreSQL if you're fancy)

### ⚡ Quick Setup (5 minutes, tops!)

1. **Clone this beauty**
   ```bash
   git clone <repository-url>
   cd cafe-royalty-system
   ```

2. **Install the PHP goodies**
   ```bash
   composer install
   ```

3. **Get the Node.js treats**
   ```bash
   npm install
   ```

4. **Set up your environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup (SQLite is our jam)**
   ```bash
   touch database/database.sqlite
   ```

6. **Run the migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed with sample data**
   ```bash
   php artisan db:seed --class=LoyaltySeeder
   ```

8. **Build the assets**
   ```bash
   npm run build
   ```

9. **Start the party!**
   ```bash
   php artisan serve
   ```

### 🔧 Environment Setup

Add these to your `.env` file:

```env
# Twilio Configuration (for SMS magic)
TWILIO_SID=your_twilio_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_FROM_NUMBER=your_twilio_phone_number

# App Configuration
APP_NAME="Sip n Save"
APP_URL=http://localhost:8000

# Database (SQLite is our default)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

## 🎭 Test Accounts (Ready to Rock!)

### 👤 Customer Account
- **Email**: john@example.com
- **Password**: Password123!
- **Phone**: 1234567890

### 👨‍💼 Staff Account
- **Email**: staff@cafe.com
- **Password**: staff123
- **Phone**: 1234567892

## 🎬 How to Use (The Fun Way!)

### 👤 Customer Adventure

1. **🎪 Register/Login**: Use your phone number (because who remembers emails?)
2. **📱 Verify Phone**: Get an OTP via SMS (like a secret handshake!)
3. **💰 Earn Points**: 
   - Scan staff QR codes (like a coffee treasure hunt!)
   - Enter purchases manually (for the adventurous souls)
4. **🎁 Redeem Points**: Turn points into discounts (your wallet's happy dance!)
5. **📊 Track Activity**: See your coffee journey unfold

### 👨‍💼 Staff Hero Journey

1. **🚀 Access Staff Dashboard**: Visit `/staff/login` or login as staff
2. **📱 Scan Customer QR Codes**: Use the built-in scanner (like a coffee superhero!)
3. **💳 Process Purchases**: Enter amounts and award points (spreading joy!)
4. **🎫 Process Redemptions**: Scan redemption QR codes (making dreams come true!)
5. **✍️ Manual Entry**: Add points manually (for those special moments)
6. **📈 View Activity**: Monitor the coffee economy

### 🎯 Staff Access Points
- **Direct URL**: `http://localhost:8000/staff/login`
- **From Customer App**: Staff users see "Staff" tab (like a secret door!)
- **QR Scanner**: Built-in camera scanner (because we're fancy!)

## 🔌 API Endpoints (For the Tech-Savvy)

### 👤 Customer Endpoints
- `GET /api/points/summary` - Get your points story
- `POST /api/purchase/qr` - Process QR code purchases
- `POST /api/purchase/manual` - Submit manual purchases
- `POST /api/points/redeem` - Redeem your hard-earned points
- `GET /api/transactions` - Your coffee transaction history
- `GET /api/redemptions` - Your redemption adventures

### 👨‍💼 Staff Endpoints
- `POST /api/staff/qr/purchase` - Generate purchase QR codes
- `POST /api/staff/qr/user` - Process user QR codes
- `POST /api/staff/qr/redemption` - Process redemption QR codes

## 🛡️ Security (Keeping Your Coffee Safe!)

### 🔐 QR Code Security
- Cryptographic signatures (because we're not messing around!)
- 5-minute expiration for purchase QR codes (fresh like your coffee!)
- 24-hour expiration for redemption QR codes (generous like a good tip!)
- One-time use only (no coffee fraud here!)

### 🚦 Rate Limiting
- 100 requests per hour per IP (keeping it fair!)
- Daily point earning limit: 100 points (because we care about your coffee budget!)
- OTP rate limiting (no spam, just coffee!)

### 🛡️ Data Protection
- HTTPS required for production (secure like a vault!)
- Input sanitization (clean like your coffee machine!)
- SQL injection prevention (because we're responsible!)
- XSS protection (keeping the bad stuff out!)

## 🛠️ Development (For the Coffee Coders!)

### 🚀 Adding New Features
1. Create migrations (database evolution!)
2. Update models (relationship building!)
3. Add Livewire components (UI magic!)
4. Create API endpoints (if needed!)
5. Update service worker (caching awesomeness!)

### 🧪 Testing
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=DashboardTest
```

### 🎨 Code Style
```bash
# Format code (keeping it pretty!)
./vendor/bin/pint

# Check code style (because we care!)
./vendor/bin/pint --test
```

## 🚀 Deployment (Taking It Live!)

### ✅ Production Checklist
- [ ] Set `APP_ENV=production` (going live!)
- [ ] Configure HTTPS (secure like a vault!)
- [ ] Set up Twilio credentials (SMS magic!)
- [ ] Configure database (data storage!)
- [ ] Set up queue worker (background magic!)
- [ ] Configure caching (speed demon!)
- [ ] Set up monitoring (keeping an eye on things!)

### 🔄 Queue Jobs
```bash
# Start queue worker
php artisan queue:work

# Process failed jobs
php artisan queue:retry all
```

## 🤝 Contributing (Join the Coffee Revolution!)

1. Fork the repository (get your own copy!)
2. Create a feature branch (branch out!)
3. Make your changes (work your magic!)
4. Add tests (because we love quality!)
5. Submit a pull request (share the love!)

## 📄 License

This project is licensed under the MIT License - because sharing is caring! ❤️

## 🆘 Support (We've Got Your Back!)

For support, please open an issue on GitHub or contact the development team. We're here to help you brew the perfect coffee experience! ☕

---

**Made with ☕ and ❤️ by coffee lovers, for coffee lovers!**

*"Life is short, drink good coffee!"* 🎉 
