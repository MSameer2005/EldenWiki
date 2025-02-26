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

## Project Structure

The project follows a structured MVC (Model-View-Controller) approach and is organized into the following directories:

```
├── css/                # Stylesheets for UI/UX
├── html/               # Static HTML pages
├── img/                # Images and multimedia assets
├── js/                 # JavaScript for frontend interactions
├── php/                # Core backend functionality
│   ├── admin/          # Admin panel for managing content
│   ├── lib/            # Utility scripts and configurations
├── sql/                # Database schema and queries
│   ├── db/             # SQL dump files
│   ├── scripts/        # Database creation and modification scripts
```

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Object-Oriented)
- **Database**: MySQL
- **Frameworks/Libraries**: None (custom-built architecture)
- **Security**: Session-based authentication, prepared SQL statements to prevent SQL injection

## Installation & Setup

### Prerequisites

- Apache Web Server (e.g., XAMPP, WAMP, or LAMP)
- PHP 7.4+
- MySQL Database

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

