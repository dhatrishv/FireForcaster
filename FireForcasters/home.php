<?php
session_start();
include ('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fire Forecaster</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #e74c3c;
      --accent-color: #3498db;
      --text-color: #2c3e50;
      --light-bg: #f8f9fa;
      --white: #ffffff;
      --shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.6;
      color: var(--text-color);
      background-color: var(--light-bg);
    }

    .navbar {
      background-color: var(--primary-color);
      padding: 0.2rem 2rem;
      box-shadow: var(--shadow);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
    }

    .navbar-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar-logo img {
      height: 80px;
      width: 80px;
      border-radius: 50%;
      transition: transform 0.3s ease;
    }

    .navbar-logo img:hover {
      transform: scale(1.05);
    }

    .navbar-menu {
      display: flex;
      gap: 2rem;
      align-items: center;
    }

    .nav-link {
      color: var(--white);
      text-decoration: none;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-link.active {
      /* No special styling for active link, matches other nav links */
    }

    .logout-button {
      background-color: var(--secondary-color);
      color: var(--white);
      padding: 0.5rem 1.5rem;
      border-radius: 4px;
      text-decoration: none;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .logout-button:hover {
      background-color: #c0392b;
      transform: translateY(-2px);
    }

    .hero-section {
      background: linear-gradient(270deg, #43cea2, #185a9d, #e74c3c, #43cea2);
      background-size: 800% 800%;
      animation: gradientBG 18s ease infinite;
      padding: 8rem 2rem 4rem;
      text-align: center;
      color: var(--white);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-content {
      max-width: 800px;
      margin: 0 auto;
      padding: 2rem;
    }
    h1 {
      white-space: nowrap;
      
    }


    .hero-content h1 {
      font-size: 3.5rem;
      margin-bottom: 1.5rem;
      font-weight: 700;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-content p {
      font-size: 1.4rem;
      margin-bottom: 2rem;
      opacity: 0.9;
    }

    .features-section {
      padding: 5rem 2rem;
      background-color: var(--white);
      text-align: center;
    }

    .features-section h2 {
      font-size: 2.5rem;
      margin-bottom: 2rem;
      color: var(--primary-color);
    }

    .features-section p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto;
      color: #666;
    }

    .menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
      padding: 0.5rem;
    }

    .menu-toggle span {
      width: 25px;
      height: 3px;
      background-color: var(--white);
      margin: 4px 0;
      transition: 0.4s;
      border-radius: 2px;
    }

    @media (max-width: 768px) {
      .navbar-menu {
        position: fixed;
        top: 70px;
        left: -100%;
        width: 100%;
        height: calc(100vh - 70px);
        background-color: var(--primary-color);
        flex-direction: column;
        padding: 2rem;
        transition: 0.3s ease;
      }

      .navbar-menu.active {
        left: 0;
      }

      .menu-toggle {
        display: flex;
      }

      .hero-content h1 {
        white-space: nowrap;
        overflow-x: auto;
      }

      .hero-content p {
        font-size: 1.2rem;
      }
    }

    /* Animation for menu toggle */
    .menu-toggle.active span:nth-child(1) {
      transform: rotate(-45deg) translate(-5px, 6px);
    }

    .menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
      transform: rotate(45deg) translate(-5px, -6px);
    }

    /* Dashboard Section */
    .dashboard-section {
      padding: 5rem 2rem;
      background-color: var(--light-bg);
      text-align: center;
    }
    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      max-width: 900px;
      margin: 2rem auto 0 auto;
    }
    .dashboard-card {
      background: var(--white);
      box-shadow: var(--shadow);
      border-radius: 10px;
      padding: 2rem 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.2s;
    }
    .dashboard-card:hover {
      transform: translateY(-5px) scale(1.03);
    }
    .dashboard-icon {
      font-size: 2.5rem;
      color: var(--secondary-color);
      margin-bottom: 1rem;
    }
    .dashboard-card h3 {
      margin-bottom: 0.5rem;
      color: var(--primary-color);
    }
    .dashboard-card p {
      font-size: 1.5rem;
      font-weight: bold;
      color: var(--accent-color);
    }

    /* Alerts Section */
    .alerts-section {
      padding: 5rem 2rem;
      background-color: var(--white);
      text-align: center;
    }
    .alerts-list {
      max-width: 700px;
      margin: 2rem auto 0 auto;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    .alert-card {
      display: flex;
      align-items: center;
      background: var(--light-bg);
      box-shadow: var(--shadow);
      border-radius: 8px;
      padding: 1.5rem;
      gap: 1.5rem;
      transition: box-shadow 0.2s;
    }
    .alert-card:hover {
      box-shadow: 0 4px 24px rgba(231, 76, 60, 0.15);
    }
    .alert-icon {
      font-size: 2rem;
      color: var(--secondary-color);
      flex-shrink: 0;
    }
    .alert-card h4 {
      margin-bottom: 0.3rem;
      color: var(--primary-color);
    }
    .alert-card p {
      margin-bottom: 0.2rem;
      color: #555;
      font-size: 1rem;
    }

    /* Benefits Section */
    .benefits-section {
      padding: 5rem 2rem;
      background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
      color: var(--white);
      text-align: center;
    }
    .benefits-list {
      list-style: none;
      max-width: 700px;
      margin: 2rem auto 0 auto;
      padding: 0;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
    }
    .benefits-list li {
      background: rgba(255,255,255,0.08);
      border-radius: 8px;
      padding: 1.5rem 1rem;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      justify-content: flex-start;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .benefits-list i {
      font-size: 1.5rem;
      color: var(--secondary-color);
      background: var(--white);
      border-radius: 50%;
      padding: 0.5rem;
      margin-right: 0.5rem;
    }
    @media (max-width: 600px) {
      .dashboard-cards, .benefits-list {
        grid-template-columns: 1fr;
      }
      .alerts-list {
        gap: 1rem;
      }
    }

    /* Blynk Button */
    .blynk-btn {
      display: inline-block;
      margin: 1.5rem auto 2rem auto;
      padding: 0.9rem 2.2rem;
      background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
      color: #fff;
      font-size: 1.2rem;
      font-weight: 600;
      border: none;
      border-radius: 30px;
      box-shadow: 0 4px 20px rgba(24,90,157,0.15);
      text-decoration: none;
      transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
      letter-spacing: 1px;
    }
    .blynk-btn:hover {
      background: linear-gradient(90deg, #185a9d 0%, #43cea2 100%);
      transform: translateY(-3px) scale(1.04);
      box-shadow: 0 8px 32px rgba(24,90,157,0.25);
    }

    /* Dashboard Single Row */
    .dashboard-cards.single-row {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: stretch;
      gap: 2rem;
      overflow-x: auto;
      max-width: 100vw;
      margin: 2rem auto 0 auto;
      scrollbar-width: thin;
      scrollbar-color: #43cea2 #eaeaea;
    }
    .dashboard-cards.single-row::-webkit-scrollbar {
      height: 8px;
    }
    .dashboard-cards.single-row::-webkit-scrollbar-thumb {
      background: #43cea2;
      border-radius: 4px;
    }
    .dashboard-card {
      min-width: 220px;
      max-width: 260px;
      background: var(--white);
      box-shadow: 0 8px 32px rgba(44,62,80,0.12), 0 1.5px 6px rgba(67,206,162,0.08);
      border-radius: 18px;
      padding: 2.2rem 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.25s, box-shadow 0.25s;
      position: relative;
    }
    .dashboard-card:hover {
      transform: translateY(-8px) scale(1.05) rotate(-1deg);
      box-shadow: 0 16px 48px rgba(44,62,80,0.18), 0 2px 12px rgba(67,206,162,0.12);
      z-index: 2;
    }
    .dashboard-icon {
      font-size: 2.7rem;
      color: var(--secondary-color);
      margin-bottom: 1.1rem;
      filter: drop-shadow(0 2px 8px rgba(231,76,60,0.12));
    }
    .dashboard-card h3 {
      margin-bottom: 0.5rem;
      color: var(--primary-color);
      font-size: 1.25rem;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .dashboard-card p {
      font-size: 1.7rem;
      font-weight: bold;
      color: var(--accent-color);
      margin-top: 0.2rem;
    }

    /* Animated Hero Section */
    @keyframes gradientBG {
      0% {background-position:0% 50%}
      50% {background-position:100% 50%}
      100% {background-position:0% 50%}
    }

    /* How Sensors Work Section */
    .sensors-section {
      padding: 5rem 2rem;
      background: var(--white);
      text-align: center;
    }
    .sensors-section h2 {
      font-size: 2.5rem;
      margin-bottom: 2.5rem;
      color: var(--primary-color);
    }
    .sensors-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 2rem;
      max-width: 1000px;
      margin: 0 auto;
    }
    .sensor-step {
      background: var(--light-bg);
      border-radius: 14px;
      box-shadow: 0 4px 24px rgba(44,62,80,0.08);
      padding: 2rem 1.2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .sensor-step:hover {
      transform: translateY(-6px) scale(1.03);
      box-shadow: 0 8px 32px rgba(44,62,80,0.14);
    }
    .sensor-icon {
      font-size: 2.5rem;
      color: var(--accent-color);
      margin-bottom: 1rem;
      background: #eaf6fb;
      border-radius: 50%;
      padding: 0.7rem;
      box-shadow: 0 2px 8px rgba(52,152,219,0.08);
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .sensor-step h4 {
      margin-bottom: 0.7rem;
      color: var(--primary-color);
      font-size: 1.15rem;
      font-weight: 600;
    }
    .sensor-step p {
      color: #555;
      font-size: 1.05rem;
      margin-bottom: 0;
    }
    @media (max-width: 600px) {
      .sensors-content {
        grid-template-columns: 1fr;
      }
    }

    .logo-image {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 2px 8px rgba(44,62,80,0.10);
    }

    /* Fire Safety & Precautions Slider Section */
    .safety-slider-section {
      padding: 5rem 2rem;
      background: var(--white);
      text-align: center;
    }
    .safety-slider-section h2 {
      font-size: 2.5rem;
      margin-bottom: 2.5rem;
      color: var(--primary-color);
    }
    .slider-container {
      display: flex;
      align-items: center;
      justify-content: center;
      max-width: 700px;
      margin: 0 auto 2rem auto;
    }
    .slides {
      width: 100%;
      overflow: hidden;
      position: relative;
      min-height: 270px;
    }
    .slide {
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.7s;
    }
    .slide.active {
      display: flex;
    }
    .slide img {
      width: 350px;
      height: 240px;
      object-fit: cover;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(44,62,80,0.10);
      margin-bottom: 1.2rem;
    }
    .slide p {
      font-size: 1.15rem;
      color: #444;
      background: #f4f8fb;
      border-radius: 8px;
      padding: 0.8rem 1.2rem;
      box-shadow: 0 2px 8px rgba(44,62,80,0.04);
      max-width: 350px;
      margin: 0 auto;
    }
    .slider-btn {
      background: var(--accent-color);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 2px 12px rgba(52,152,219,0.15);
      transition: background 0.2s, transform 0.2s;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 2;
    }
    .slider-btn.prev {
      left: 10px;
    }
    .slider-btn.next {
      right: 10px;
    }
    .slider-btn:hover {
      background: var(--secondary-color);
      transform: scale(1.08);
    }
    .slider-dots {
      display: flex;
      justify-content: center;
      gap: 0.7rem;
      margin-top: 0.5rem;
    }
    .dot {
      width: 13px;
      height: 13px;
      background: #e0e0e0;
      border-radius: 50%;
      display: inline-block;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
    }
    .dot.active {
      background: var(--accent-color);
      transform: scale(1.2);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 600px) {
      .slider-container {
        flex-direction: column;
      }
      .slide img {
        width: 100%;
        height: 140px;
      }
      .slider-btn {
        width: 38px;
        height: 38px;
        font-size: 1.1rem;
      }
      .slider-btn.prev {
        left: 5px !important;
      }
      .slider-btn.next {
        right: 5px !important;
      }
    }
    /* Footer Styles */
.footer {
    background-color: #1a1a1a;
    color: #ffffff;
    padding: 40px 0 20px;
    margin-top: 50px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    padding: 0 20px;
}

.footer-section h4 {
    color: #ffffff;
    margin-bottom: 20px;
    font-size: 1.2rem;
}

.footer-section p {
    margin: 10px 0;
    color: #b3b3b3;
}

.footer-section ul {
    list-style: none;
}

.footer-section ul li {
    margin: 10px 0;
}

.footer-section ul li a {
    color: #b3b3b3;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: #ffffff;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-links a {
    color: #b3b3b3;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: #ffffff;
}

.footer-bottom {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #333;
}

.footer-bottom p {
    color: #b3b3b3;
    margin: 5px 0;
}

.footer-bottom i.fa-heart {
    color: #ff4444;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .social-links {
        justify-content: center;
    }
}

/* Icons spacing */
.fas, .fab {
    margin-right: 8px;
}

    /* About Us Section Styles */
    .about-content {
      max-width: 900px;
      margin: 0 auto;
      text-align: left;
      font-size: 1.15rem;
      color: #333;
    }
    .about-columns {
      display: flex;
      gap: 40px;
      margin: 2rem 0;
      flex-wrap: wrap;
    }
    .about-col {
      flex: 1 1 300px;
      background: #f8f9fa;
      border-radius: 10px;
      padding: 1.5rem 1.2rem;
      box-shadow: 0 2px 12px rgba(44,62,80,0.06);
    }
    .about-col h3 {
      color: #2c3e50;
      margin-bottom: 1rem;
      font-size: 1.2rem;
    }
    .about-col ul {
      padding-left: 1.2rem;
    }
    .about-col li {
      margin-bottom: 0.7rem;
      line-height: 1.5;
    }
    .about-mission {
      margin-top: 2rem;
      font-size: 1.1rem;
      color: #185a9d;
      text-align: center;
    }
    @media (max-width: 800px) {
      .about-columns {
        flex-direction: column;
        gap: 20px;
      }
    }

    /* Sensor Dashboard Section */
    .sensor-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      padding: 2rem 2rem 1.5rem 2rem;
      width: 350px;
      min-height: 260px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }
    .sensor-title {
      font-size: 1.6rem;
      margin-bottom: 0.5rem;
      font-weight: 400;
    }
    .gauge-container {
      position: relative;
      width: 180px;
      margin: 0 auto;
      text-align: center;
    }
    .gauge-number {
      text-align: center;
      font-size: 2.1rem;
      font-weight: 600;
      margin-bottom: 0.2rem;
    }
    .gauge-emoji {
      display: block;
      text-align: center;
      font-size: 2.5rem;
      margin-top: -10px;
      margin-bottom: 0.5rem;
      transition: opacity 0.4s cubic-bezier(0.4,0,0.2,1), transform 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .gauge-emoji.animated {
      opacity: 0.3;
      transform: scale(1.2);
    }
    .gauge-value { display: none; } /* Hide old class if present */
    .gauge-labels {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      font-size: 1.3rem;
      color: #222;
    }
    svg path {
      transition: stroke-dashoffset 0.6s cubic-bezier(0.4,0,0.2,1);
    }

  </style>
  <script>
    function toggleMenu() {
      const menu = document.querySelector('.navbar-menu');
      const toggle = document.querySelector('.menu-toggle');
      menu.classList.toggle('active');
      toggle.classList.toggle('active');
    }

    function handleLogout() {
      // Implement logout functionality here
      alert('Logged out successfully!');
    }

    function animateGaugeNumber(element, start, end, duration = 600) {
      if (start === end) return;
      let startTimestamp = null;
      const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.round(start + (end - start) * progress);
        element.textContent = value;
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          element.textContent = end;
        }
      };
      requestAnimationFrame(step);
    }

    function animateArc(arcId, value, min, max, invert = false) {
      const arc = document.getElementById(arcId);
      const percent = (value - min) / (max - min);
      const totalLength = 236;
      let offset;
      if (invert) {
        offset = totalLength * percent;
      } else {
        offset = totalLength * (1 - percent);
      }
      arc.style.transition = 'stroke-dashoffset 0.6s cubic-bezier(0.4,0,0.2,1)';
      arc.style.strokeDashoffset = offset;
    }

    function setFireValue(val) {
      const numEl = document.getElementById('fire-number');
      const emojiEl = document.getElementById('fire-value');
      numEl.classList.add('animated');
      const current = parseInt(numEl.textContent);
      const target = parseInt(val);
      animateGaugeNumber(numEl, current, target, 600);
      setTimeout(() => numEl.classList.remove('animated'), 400);
      emojiEl.textContent = '🔥';
      animateArc('fire-arc', target, 0, 1);
    }
    function setGasValue(val) {
      const numEl = document.getElementById('gas-number');
      const emojiEl = document.getElementById('gas-value');
      numEl.classList.add('animated');
      const current = isNaN(parseInt(numEl.textContent)) ? 252 : parseInt(numEl.textContent);
      if (val === '400+') {
        animateGaugeNumber(numEl, current, 400, 600);
        setTimeout(() => { numEl.textContent = '400+'; numEl.classList.remove('animated'); }, 600);
        emojiEl.textContent = '⚠️';
        animateArc('gas-arc', 400, 200, 400);
      } else {
        animateGaugeNumber(numEl, 400, 252, 600);
        setTimeout(() => { numEl.textContent = '252'; numEl.classList.remove('animated'); }, 600);
        emojiEl.textContent = '⚠️';
        animateArc('gas-arc', 252, 200, 400);
      }
    }
    document.addEventListener('DOMContentLoaded', function() {
      animateArc('fire-arc', 1, 0, 1);
      animateArc('gas-arc', 252, 200, 400);
    });
  </script>
</head>
<body>

  <!-- Navbar Section -->
  <nav class="navbar">
    <div class="navbar-container">
      <a href="#home" class="navbar-logo">
        <img src="logo.jpg" alt="Fire Forecaster Logo" class="logo-image">
      </a>

      <button class="menu-toggle" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <div class="navbar-menu">
        <a href="#home" class="nav-link active">Home</a>
        <a href="#about" class="nav-link">About</a>
        <a href="logout.php" class="nav-link logout-button" onclick="handleLogout()">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main>
    <section id="home">
      <div class="hero-section">
        <div class="hero-content">
          <h1>Welcome to Fire Forecaster</h1>
          <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
          <p>Your safety is our priority. Stay updated with real-time fire alerts.</p>
           <a href="https://blynk.cloud/dashboard/487846/global/devices/1/organization/487846/devices/1581644/dashboard" target="_blank" class="blynk-btn">Go to Blynk Dashboard</a>
        </div>
        <!-- <div class="hero-image">
          <img src="hero-image.jpg" alt="Hero Image">
        </div> -->
      </div>
    </section>

    
    <h2 style="text-align:center; font-size:2.3rem; font-weight:600; margin-top:2.5rem; margin-bottom:0.5rem; letter-spacing:1px; color:#2c3e50;">Dashboard</h2>
    <div style="display: flex; gap: 2rem; justify-content: center; margin: 3rem 0;">
      <!-- Fire Sensor Card -->
      <div class="sensor-card">
        <div class="sensor-title">fire</div>
        <div class="gauge-container" id="fire-gauge" onmouseover="setFireValue(0)" onmouseout="setFireValue(1)">
          <div class="gauge-number" id="fire-number">1</div>
          <svg width="180" height="90" viewBox="0 0 180 90">
            <path d="M15,90 A75,75 0 0,1 165,90" stroke="#e0e0e0" stroke-width="15" fill="none"/>
            <path id="fire-arc" d="M15,90 A75,75 0 0,1 165,90" stroke="#011627" stroke-width="15" fill="none" style="stroke-dasharray:236; stroke-dashoffset:0;"/>
          </svg>
          <div class="gauge-emoji" id="fire-value">🔥</div>
          <div class="gauge-labels">
            <span>0</span>
            <span>1</span>
          </div>
        </div>
      </div>
      <!-- Gas Sensor Card -->
      <div class="sensor-card">
        <div class="sensor-title">gas</div>
        <div class="gauge-container" id="gas-gauge" onmouseover="setGasValue('400+')" onmouseout="setGasValue(252)">
          <div class="gauge-number" id="gas-number">252</div>
          <svg width="180" height="90" viewBox="0 0 180 90">
            <path d="M15,90 A75,75 0 0,1 165,90" stroke="#eee" stroke-width="15" fill="none"/>
            <path id="gas-arc" d="M15,90 A75,75 0 0,1 165,90" stroke="#888" stroke-width="15" fill="none" style="stroke-dasharray:236; stroke-dashoffset:0;"/>
          </svg>
          <div class="gauge-emoji" id="gas-value">⚠️</div>
          <div class="gauge-labels">
            <span>200</span>
            <span>400</span>
          </div>
        </div>
      </div>
    </div>

    <section id="about" class="features-section">
      <h2>About Us</h2>
      <div class="about-content">
        <p>
          <strong>Fire Forecaster</strong> is dedicated to protecting lives and property by providing real-time fire detection, alerts, and safety resources. Founded by a team of passionate engineers and safety experts, we leverage advanced sensor technology and smart analytics to deliver timely, accurate information when it matters most.
        </p>
        <div class="about-columns">
          <div class="about-col">
            <h3>What We Do</h3>
            <ul>
              <li><strong>Real-Time Monitoring:</strong> Our intelligent sensors continuously monitor for signs of fire, smoke, and hazardous gases.</li>
              <li><strong>Instant Alerts:</strong> Immediate notifications to users and emergency services for rapid response.</li>
              <li><strong>Safety Resources:</strong> Practical safety tips, evacuation plans, and up-to-date information to keep you prepared.</li>
              <li><strong>Community Focus:</strong> Empowering communities with tools and knowledge to prevent and respond to fire emergencies.</li>
            </ul>
          </div>
          <div class="about-col">
            <h3>Why Choose Fire Forecaster?</h3>
            <ul>
              <li>Cutting-edge technology for early fire detection</li>
              <li>Reliable, location-based alerts</li>
              <li>User-friendly dashboard and mobile access</li>
              <li>Dedicated support and continuous innovation</li>
            </ul>
          </div>
        </div>
        <p class="about-mission">
          <em>Your safety is our top priority. With Fire Forecaster, you can stay informed, stay prepared, and stay safe.</em>
        </p>
      </div>
    </section>

    <!-- Fire Safety & Precautions Slider Section -->
    <section id="safety-slider" class="safety-slider-section">
      <h2>Fire Safety & Precautions</h2>
      <div class="slider-container">
        <div class="slides">
          <button class="slider-btn prev" onclick="moveSlide(-1)"><i class="fas fa-chevron-left"></i></button>
          <div class="slide active">
            <img src="staylow.jpg" alt="Stay low to avoid smoke">
            <p><strong>Stay Low:</strong> Crawl under smoke to avoid inhaling dangerous fumes.</p>
          </div>
          <div class="slide">
            <img src="nose.jpg" alt="Wet cloth for nose and mouth">
            <p><strong>Cover Up:</strong> Use a wet cloth to cover your nose and mouth if smoke is present.</p>
          </div>
          <div class="slide">
            <img src="elevator.jpg" alt="Don't use elevators">
            <p><strong>Avoid Elevators:</strong> Always use stairs, never elevators, during a fire.</p>
          </div>
          <div class="slide">
            <img src="call.jpg" alt="Call emergency services">
            <p><strong>Call for Help:</strong> Dial emergency services as soon as you are safe.</p>
          </div>
          <div class="slide">
            <img src="route.png" alt="Know your escape route">
            <p><strong>Plan Ahead:</strong> Know your escape routes and practice fire drills regularly.</p>
          </div>
          <button class="slider-btn next" onclick="moveSlide(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
      </div>
      <div class="slider-dots">
        <span class="dot active" onclick="currentSlide(0)"></span>
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
      </div>
    </section>

    <section id="sensors" class="sensors-section">
      <h2>How Our Sensors Work</h2>
      <div class="sensors-content">
        <div class="sensor-step">
          <span class="sensor-icon"><i class="fas fa-thermometer-half"></i></span>
          <h4>1. Real-Time Detection</h4>
          <p>Our advanced sensors continuously monitor temperature, smoke, and gas levels in the environment to detect early signs of fire.</p>
        </div>
        <div class="sensor-step">
          <span class="sensor-icon"><i class="fas fa-broadcast-tower"></i></span>
          <h4>2. Data Transmission</h4>
          <p>Sensor data is instantly transmitted to our secure cloud platform using reliable wireless technology.</p>
        </div>
        <div class="sensor-step">
          <span class="sensor-icon"><i class="fas fa-database"></i></span>
          <h4>3. Smart Analysis</h4>
          <p>Our system analyzes incoming data in real time, identifying potential fire hazards and filtering out false alarms.</p>
        </div>
        <div class="sensor-step">
          <span class="sensor-icon"><i class="fas fa-bell"></i></span>
          <h4>4. Instant Alerts</h4>
          <p>When a threat is detected, instant alerts are sent to users and authorities, ensuring rapid response and safety.</p>
        </div>
      </div>
    </section>

    <section id="benefits" class="benefits-section">
      <h2>What makes us different?</h2>
      <ul class="benefits-list">
        <li><i class="fas fa-bolt"></i> Real-time fire alerts</li>
        <li><i class="fas fa-map-marker-alt"></i> Location-based notifications</li>
        <li><i class="fas fa-user-shield"></i> Safety tips and resources</li>
        <li><i class="fas fa-mobile-alt"></i> Mobile-friendly experience</li>
        <li><i class="fas fa-headset"></i> 24/7 support</li>
        <li><i class="fas fa-home"></i> Seamless integration with smart home systems</li>
      </ul>
    </section>
  </main>

  <script>
    // Slider JS
    let slideIndex = 0;
    function showSlide(n) {
      const slides = document.querySelectorAll('.slide');
      const dots = document.querySelectorAll('.dot');
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        dots[i].classList.remove('active');
      });
      slides[n].classList.add('active');
      dots[n].classList.add('active');
      slideIndex = n;
    }

    function moveSlide(n) {
      const slides = document.querySelectorAll('.slide');
      let newIndex = slideIndex + n;
      if (newIndex < 0) newIndex = slides.length - 1;
      if (newIndex >= slides.length) newIndex = 0;
      showSlide(newIndex);
    }

    function currentSlide(n) {
      showSlide(n);
    }

    // Initialize first slide
    document.addEventListener('DOMContentLoaded', () => {
      showSlide(0);
    });
  </script>
</body>
<footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-phone"></i> +91 9012345675</p>
                    <p><i class="fas fa-envelope"></i> Codealchemists@gmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Bangalore-583104</p>
                </div>
                
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
                        <li><a href="#"><i class="fas fa-book"></i> Documentation</a></li>
                        <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Connect With Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 CODE ALCHEMISTS. All rights reserved.</p>
                <p>Designed for your safety</p>
            </div>
        </footer>

</html> 