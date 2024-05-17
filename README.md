
# Red Dine Web Application

Welcome to RedDine, an intuitive online food ordering system designed to provide a seamless and enjoyable user experience. RedDine is developed using PHP, HTML, CSS, and vanilla JavaScript, offering a robust platform for both customers and administrators.


## Overview

RedDine enables users to browse a variety of food categories and products, add items to their cart, adjust quantities, and securely checkout. Additionally, RedDine includes a comprehensive web-master frontend, empowering administrators to manage the website's content and respond to customer orders efficiently.
## Screenshots

![App Screenshot 1](https://i.ibb.co/zfwdCfF/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 2](https://i.ibb.co/TRgB70H/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 3](https://i.ibb.co/QvyGQQ7/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 4](https://i.ibb.co/TtSfcgr/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 5](https://i.ibb.co/FDvqnWF/Screenshot-18-5-2024-23623-localhost.jpg)

![App Screenshot 6](https://i.ibb.co/GQhn7z1/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 7](https://i.ibb.co/LPcHvsw/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 8](https://i.ibb.co/C8R4Hcn/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 9](https://i.ibb.co/CW0jGc6/Screenshot-18-5-2024-23729-localhost.jpg)

![App Screenshot 10](https://i.ibb.co/tLQkwX8/Screenshot-18-5-2024-23623-localhost.jpg)

![App Screenshot 11](https://i.ibb.co/PrNK12d/Screenshot-18-5-2024-23729-localhost.jpg)


## Key Features
### User Interface
- User Accounts: Users can create and manage their accounts for a personalized experience.
- Product Browsing: Explore a diverse range of food categories and products.
- Cart Management: Easily add items to the cart, adjust quantities, and remove items.
- Checkout Process: Smooth and secure checkout process for placing orders.

### Administrator Interface
- Category Management: Add, edit, or delete product categories to keep the menu up-to-date.
- Product Management: Manage the inventory by adding, updating, or removing products within categories.
- Order Management: View and respond to customer orders in real-time.
Technologies Used
- PHP: Server-side scripting language for backend logic.
- HTML: Markup language for structuring the web pages.
- CSS: Styling language for designing the user interface.
- JavaScript: Programming language for interactive and dynamic elements.


## Installation

To get started with RedDine, follow these steps:

1. **Clone the Repository:** Clone the RedDine repository to your local machine (use www directory for WAMP, htdocs directory for XAMPP for convenience).
```bash
git clone https://github.com/yourusername/reddine.git
```

2. **Install Composer:** Install Composer (a dependency management tool for php) on your computer.

3. **Install [Firebase Admin SDK for PHP]("firebase-php.readthedocs.io")**: Install firebase admin sdk for php with the help of *Composer*
```bash
composer require kreait/firebase-php
```

4. **Create a firebase project:** Create a firebase project on your firebase console and setup a storage bucket. (set read access to public for convenience) And then change the following lines in `firebase-config.php` file accordingly.
```php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../red-dine-webapp-firebase-adminsdk-wnfze-0f6fd46e97.json'); // change this line accordingly
$storage = $factory
    ->withDefaultStorageBucket("red-dine-webapp.appspot.com") // change this line accordingly
    ->createStorage();
$bucket = $storage->getBucket();
```

5. **Setup the Database:** Import the provided SQL file to set up the database.
```sql
CREATE DATABASE red-dine;
USE red-dine;
SOURCE /path/to/red-dine.sql;
```

6. **Run MySQL** on port 3306 using WAMP/XAMPP

7. **Access the Application:** Open your web browser and navigate to `http://localhost/red-dine-web`.
## Contributing

Contributions are welcome! 

If you have suggestions for improvements or encounter any issues, please open an issue or submit a pull request.


## License
This project is licensed under the MIT License - see the [LICENSE]("https://github.com/DilanSriyantha/red-dine-web-application?tab=MIT-1-ov-file#readme") file for details.


### 
Feel free to customize this README introduction to better suit your specific project needs.
