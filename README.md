# Birthday Website for Aghni Habibah Putriana

A beautiful, full-featured birthday website built with pure PHP and Bootstrap 5.

## Features

- **Landing Page**: Colorful design with confetti effects, background music, and countdown timer
- **Photo Gallery**: Upload and display birthday photos with modal view
- **Guest Wishes**: Interactive guestbook for birthday messages
- **Admin Dashboard**: Password-protected management panel
- **Responsive Design**: Works perfectly on all devices
- **Beautiful Animations**: Floating elements, confetti, and smooth transitions

## Installation

1. Download and extract the files to your XAMPP `htdocs` directory:
   ```
   htdocs/ulang_tahun/
   ```

2. Start XAMPP (Apache service)

3. Visit `http://localhost/ulang_tahun/` in your browser

## Admin Access

- **URL**: `http://localhost/ulang_tahun/dashboard.php`
- **Username**: `admin`
- **Password**: `aghni2025`

## File Structure

```
ulang_tahun/
├── index.php             # Landing page with greeting and countdown
├── dashboard.php         # Admin dashboard with login
├── gallery.php           # Photo gallery with upload
├── wishes.php            # Guestbook for birthday messages
├── includes/
│   ├── header.php        # Navigation header
│   └── footer.php        # Footer component
├── assets/
│   ├── css/
│   │   └── style.css     # Custom styles
│   ├── js/
│   │   └── script.js     # JavaScript functionality
│   ├── img/              # Uploaded images storage
│   └── music/            # Background music files
├── db/
│   └── wishes.txt        # Text-based storage for wishes
└── README.md
```

## Customization

### Colors and Theme
Edit `assets/css/style.css` to modify the color scheme:
- Primary colors: `--primary-pink` and `--primary-purple`
- Pastel backgrounds: `--pastel-pink` and `--pastel-purple`

### Birthday Date
Modify the countdown timer in `assets/js/script.js`:
```javascript
let birthday = new Date(currentYear, 11, 25).getTime(); // December 25
```

### Background Music
Replace `assets/music/birthday-song.mp3` with your preferred birthday song.

### Admin Credentials
Change the password in `dashboard.php`:
```php
$_POST['password'] ?? '' === 'your-new-password'
```

## Browser Compatibility

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Requirements

- PHP 7.4 or higher
- Apache web server (XAMPP recommended)
- Modern web browser with JavaScript enabled

## Security Notes

- In production, use proper password hashing
- Implement CSRF protection for forms
- Add file upload validation and sanitization
- Use a proper database instead of text files

## License

This project is created for personal use. Feel free to modify and customize as needed.

---

Made with ❤️ for Aghni Habibah Putriana's Birthday Celebration