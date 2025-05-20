# Elden Ring Wiki Project

## Overview

The **Elden Ring Wiki Project** is a web-based platform designed to serve as a comprehensive database for the game *Elden Ring*. The website provides structured information on weapons, armor, spells, status effects, and game lore, offering a user-friendly interface for players to explore and interact with the game's mechanics.

## Features

- **Weapons Database**: Detailed information on all weapons, including attack and defense stats, scaling, and acquisition methods.
- **Armor and Equipment**: Complete list of armor sets, their attributes, and effects.
- **Magic and Spells**: Categorized list of sorceries, incantations, and Ashes of War with their descriptions and requirements.
- **Status Effects**: Comprehensive guide on all in-game status effects, including their causes, effects, and countermeasures.
- **Lore and Walkthroughs**: Sections dedicated to game lore, character backgrounds, and gameplay guides.
- **User Authentication**: Secure login and registration system with role-based access for administrators.
- **Search and Filtering**: Advanced filtering and search functionality to quickly find specific information.
- **Admin Panel**: CRUD functionalities for managing database entries, allowing admins to add, update, and delete weapons and other in-game elements.
- **Responsive Design**: Mobile-friendly interface with adaptive layouts for all screen sizes.
- **Interactive UI**: Modern user interface with smooth animations and transitions.
- **Password Security**: Enhanced password fields with visibility toggle and confirmation validation.
- **Dynamic Content Loading**: Efficient content loading with pagination and filtering options.

## Project Structure

The project follows a structured MVC (Model-View-Controller) approach and is organized into the following directories:

```
├── css/                # Stylesheets for UI/UX
│   ├── Header.css      # Navigation and header styles
│   ├── Body.css        # Main content styles
│   ├── LogIn.css       # Login page styles
│   ├── SignUp.css      # Registration page styles
│   ├── Armi.css        # Weapons page styles
│   ├── weapon_details.css # Weapon details styles
│   └── ...            # Other component-specific styles
├── php/               # Core backend functionality
│   ├── admin/         # Admin panel for managing content
│   ├── lib/           # Utility scripts and configurations
│   ├── Home.php       # Homepage controller
│   ├── LogIn.php      # Login controller
│   ├── SignUp.php     # Registration controller
│   ├── Armi.php       # Weapons controller
│   └── ...           # Other page controllers
├── js/                # JavaScript for frontend interactions
├── img/               # Images and multimedia assets
├── sql/               # Database schema and queries
│   ├── db/            # SQL dump files
│   └── scripts/       # Database creation and modification scripts
```

## Technologies Used

- **Frontend**: 
  - HTML5
  - CSS3 (with modern features like Flexbox and Grid)
  - JavaScript (ES6+)
  - SVG for icons and graphics
- **Backend**: 
  - PHP 7.4+ (Object-Oriented)
  - PDO for database connections
  - Session-based authentication
- **Database**: 
  - MySQL
  - Prepared statements for security
- **Security Features**:
  - Password hashing with BCRYPT
  - SQL injection prevention
  - XSS protection
  - CSRF protection
- **Development Tools**:
  - Git for version control
  - VS Code integration
  - AMPPS for local development

## Installation & Setup

### Prerequisites

- Apache Web Server (e.g., XAMPP, WAMP, or LAMP)
- PHP 7.4+
- MySQL Database
- AMPPS (recommended for local development)

### Steps to Run the Project

1. **Clone the repository**
   ```sh
   git clone https://github.com/your-repo/eldenring-wiki.git
   ```
2. **Set up the database**
   - Import `sql/db/EldenRing.sql` into your MySQL server.
   - Ensure that the database credentials in `php/lib/config.php` match your local database settings.
3. **Run the project on a local server**
   - Place the project folder inside your local web server's root directory (e.g., `htdocs` for XAMPP, `www` for AMPPS).
   - Start Apache and MySQL.
   - Access the website via `http://localhost/eldenring-wiki/`

## User Interface Features

- **Modern Navigation**: Responsive navigation bar with dropdown menus
- **Dynamic Forms**: Interactive forms with real-time validation
- **Password Management**: Secure password fields with visibility toggle
- **Responsive Tables**: Sortable and filterable data tables
- **Modal Dialogs**: Interactive popups for detailed information
- **Loading States**: Visual feedback for async operations
- **Error Handling**: User-friendly error messages and notifications

## Security Features

- **Authentication**: Secure login and registration system
- **Authorization**: Role-based access control
- **Data Protection**: Encrypted password storage
- **Input Validation**: Server-side and client-side validation
- **Session Management**: Secure session handling
- **SQL Injection Prevention**: Prepared statements
- **XSS Protection**: Output escaping and sanitization

## Contributions

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`feature/your-feature`)
3. Commit your changes (`git commit -m 'Add feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Create a Pull Request

## License

This project is for educational and non-commercial purposes. All *Elden Ring* assets and information belong to **FromSoftware**.

---

For any inquiries or issues, please contact **[m.0505.sameer@gmail.com](mailto\:m.0505.sameer@gmail.com)**.

