<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo_pagina ?? 'Pastelería Artesanal - Dulzura Hecha en Casa'; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary: #4a2e18;
            --secondary: #d4a373;
            --accent: #e09f84;
            --bg: #fcf9f2;
            --card-bg: #ffffff;
            --text: #333333;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 3rem;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .logo-badge {
            background-color: #f3c6bb;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: var(--accent);
        }

        .btn-header {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-header:hover {
            background-color: #2e1c0e;
        }

        .hero {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=1600&q=80') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 1rem;
            margin-top: 70px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 10px;
            font-family: serif;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 25px;
            font-weight: 300;
        }

        .btn-hero {
            background-color: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid var(--secondary);
            transition: all 0.3s;
        }

        .btn-hero:hover {
            background-color: var(--secondary);
            color: var(--primary);
        }

        section {
            padding: 5rem 2rem 3rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            font-family: serif;
            margin-bottom: 8px;
        }

        .section-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .divider {
            width: 60px;
            height: 3px;
            background-color: var(--accent);
            margin: 0 auto 40px auto;
        }

        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-title {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: bold;
        }

        .card-desc {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px 20px 20px;
        }

        .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary);
        }

        .btn-card {
            background-color: #faedcd;
            color: var(--primary);
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-card:hover {
            background-color: var(--accent);
            color: white;
        }

        .order-section {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .order-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: var(--primary);
        }

        .form-control {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            background-color: #faf9f6;
        }

        .btn-submit {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #2e1c0e;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .faq-question {
            padding: 18px 20px;
            font-weight: bold;
            color: var(--primary);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 0 20px 18px 20px;
            color: #555;
            font-size: 0.95rem;
            line-height: 1.5;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .info-box {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 1.05rem;
            color: var(--primary);
        }

        footer {
            background-color: var(--primary);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        @media(max-width: 768px) {
            .order-section, .contact-grid {
                grid-template-columns: 1fr;
            }
            header {
                padding: 1rem;
            }
            nav {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <div class="logo-badge">🍰</div>
            <span>Pastelería Artesanal</span>
        </div>
        <?php require_once __DIR__ . '/nav.php'; ?>
        <a href="#pedidos" class="btn-header">Hacer Pedido</a>
    </header>