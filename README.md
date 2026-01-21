# Europe Travel Guide

![HTML5](https://img.shields.io/badge/HTML5-%23E34F26.svg?style=flat&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-%231572B6.svg?style=flat&logo=css3&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-%23777BB4.svg?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-%2300f.svg?style=flat&logo=mysql&logoColor=white)

**Europe Travel Guide** is a responsive web application that provides essential information about **18 European countries**, including landmarks, traditional food, and travel planning tips. Users can also leave advice/comments, but only if they are **registered and logged in**.

---

## Screenshots

![Home Page - Top](images/home_top.png)
*Home page - top section*

![Home Page - Bottom](images/home_bottom.png)
*Home page - bottom section*

![Intro Page Bosnia & Herzegovina](images/intro_bih.png)
*Intro page with country info*

![Monuments Page Bosnia & Herzegovina](images/monuments_bih.png)
*Monuments page*

![Trip Plan Page Bosnia & Herzegovina](images/trip_bih.png)
*Trip plan page*

![Advice/Comment Page Bosnia & Herzegovina](images/advice_bih.png)
*Advice/comment section*

![Login Form Bosnia & Herzegovina](images/login_bih.png)
*Login page*

![SignUp Form Bosnia & Herzegovina](images/signup_bih.png)
*SignUp page*

---

## Technologies

- **Backend:** PHP 8+
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3 (responsive design with media queries)
- **Security:** password_hash, prepared statements, htmlspecialchars, login rate limiting (max 3 attempts + 24h block)
- **Tools:** XAMPP (local development)

---

## Features

- User registration and login (with password hashing)
- Add comments/advice per country
- Delete your own comments
- Display comments with date and username
- Responsive design (mobile, tablet, desktop)
- 18 countries with their own pages, flags, and themed colors

---

## How to Run Locally

1. Install XAMPP (or WAMP/MAMP) and start Apache + MySQL
2. Copy the entire project to the `htdocs` folder (e.g., `C:\xampp\htdocs\TravelGuideEurope`)
3. Create the database `myDB` in phpMyAdmin (or let `config.php` create it)
4. Open in browser:
   - `http://localhost/TravelGuideEurope/home.html`
   - or `http://localhost/TravelGuideEurope/austria/austria_advice.php`

---

## Author

**Ada**  
Lukavac, Bosnia & Herzegovina  
 
[GitHub](https://github.com/a9t9Ada/Europe-Travel-Guide)
[LinkedIn](www.linkedin.com/in/adelina-tufekcic-3325b8373)
---
**This project is created for learning and portfolio purposes – strictly educational.**

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

