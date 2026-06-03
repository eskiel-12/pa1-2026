<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Geosite Danau Toba')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* ============================= */
        /* GLOBAL STYLES & VARIABLES    */
        /* ============================= */
        * { 
            font-family: 'Inter', sans-serif;
        }
        
        :root {
            --blue-dark: #003366;
            --blue-medium: #1a4a7a;
            --gold: #c6a43b;
            --gold-light: #e0c678;
            --white: #ffffff;
            --text-light: rgba(255, 255, 255, 0.7);
            --transition-speed: 0.3s;
            --transition-timing: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        html { scroll-behavior: smooth; }
        body { overflow-x: hidden; }
        
        /* ============================= */
        /* NAVBAR STYLES               */
        /* ============================= */
        .navbar {
            transition: all 0.4s var(--transition-timing);
            padding: 0.8rem 0;
            background: linear-gradient(135deg, rgba(0, 51, 102, 0.95) 0%, rgba(26, 74, 122, 0.92) 100%);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(198, 164, 59, 0.2);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .navbar.scrolled {
            background: linear-gradient(135deg, rgba(0, 51, 102, 0.98) 0%, rgba(26, 74, 122, 0.96) 100%);
            padding: 0.5rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-bottom-width: 1px;
        }
        
        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 1rem;
        }
        
        /* ============================= */
        /* LOGO WRAPPER & BRANDING      */
        /* ============================= */
        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            padding: 0;
            flex-shrink: 0;
        }
        
        .logo-img {
            height: 40px;
            width: auto;
            border-radius: 8px;
            object-fit: cover;
            transition: all var(--transition-speed) var(--transition-timing);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .logo-img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(198, 164, 59, 0.3);
        }
        
        .logo-divider {
            width: 2px;
            height: 30px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.2) 0%, rgba(198, 164, 59, 0.4) 50%, rgba(255, 255, 255, 0.2) 100%);
            border-radius: 1px;
        }
        
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: white !important;
            margin: 0;
            padding: 0;
            letter-spacing: -0.5px;
            transition: all var(--transition-speed) var(--transition-timing);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .navbar-brand:hover {
            color: var(--gold-light) !important;
        }
        
        .navbar-brand span { 
            color: var(--gold);
            transition: color var(--transition-speed) var(--transition-timing);
        }
        
        .navbar-brand:hover span {
            color: var(--gold-light);
            text-shadow: 0 0 10px rgba(198, 164, 59, 0.4);
        }
        
        /* ============================= */
        /* NAVIGATION LINKS             */
        /* ============================= */
        .navbar-nav {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-item {
            list-style: none;
            position: relative;
        }
        
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all var(--transition-speed) var(--transition-timing);
            font-size: 0.95rem;
            padding: 0.6rem 1rem !important;
            border-radius: 10px;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(198, 164, 59, 0.1);
            transition: left var(--transition-speed) var(--transition-timing);
            z-index: -1;
        }
        
        .nav-link:hover::before {
            left: 0;
        }
        
        .nav-link:hover {
            color: var(--gold-light) !important;
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            color: var(--gold) !important;
            background: rgba(198, 164, 59, 0.15);
            border-left: 3px solid var(--gold);
            box-shadow: inset 0 2px 8px rgba(198, 164, 59, 0.1);
        }
        
        .nav-link i {
            transition: transform var(--transition-speed) var(--transition-timing);
        }
        
        .nav-link:hover i {
            transform: scale(1.15);
        }
        
        /* ============================= */
        /* DROPDOWN MENUS               */
        /* ============================= */
        .dropdown-toggle::after {
            content: '';
            display: inline-block;
            margin-left: 0.4rem;
            vertical-align: 0.3rem;
            border-left: 0.3em solid transparent;
            border-right: 0.3em solid transparent;
            border-top: 0.3em solid currentColor;
            transition: transform var(--transition-speed) var(--transition-timing);
        }
        
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
        
        .dropdown-menu {
            background: rgba(0, 51, 102, 0.98);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(198, 164, 59, 0.2);
            border-radius: 12px;
            padding: 0.75rem 0;
            margin-top: 0.7rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            animation: dropdownSlideIn 0.3s var(--transition-timing);
            min-width: 180px;
        }
        
        @keyframes dropdownSlideIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            color: white;
            padding: 10px 20px;
            font-size: 0.9rem;
            transition: all var(--transition-speed) var(--transition-timing);
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--gold);
            transform: scaleY(0);
            transform-origin: top;
            transition: transform var(--transition-speed) var(--transition-timing);
        }
        
        .dropdown-item:hover::before {
            transform: scaleY(1);
        }
        
        .dropdown-item:hover {
            background: rgba(198, 164, 59, 0.2);
            color: var(--gold-light);
            transform: translateX(8px);
            padding-left: 24px;
        }
        
        .dropdown-header {
            color: var(--gold);
            padding: 10px 20px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
        }
        
        .dropdown-divider {
            border-top: 1px solid rgba(198, 164, 59, 0.2);
            margin: 0.7rem 0;
        }
        
        /* ============================= */
        /* MOBILE TOGGLE BUTTON         */
        /* ============================= */
        .navbar-toggler {
            border: none;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 14px;
            border-radius: 12px;
            transition: all var(--transition-speed) var(--transition-timing);
            flex-shrink: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(198, 164, 59, 0.3);
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }
        
        .navbar-toggler[aria-expanded="true"] {
            background: rgba(198, 164, 59, 0.2);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 24px;
            height: 24px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        
        /* ============================= */
        /* FOOTER STYLES                */
        /* ============================= */
        .footer {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-medium) 100%);
            color: white;
            padding: 50px 0 20px;
            margin-top: 0;
            border-top: 2px solid rgba(198, 164, 59, 0.2);
        }
        
        .footer h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            display: inline-block;
            transition: all var(--transition-speed) var(--transition-timing);
        }
        
        .footer h5:hover {
            color: var(--gold-light);
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 35px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold) 0%, transparent 100%);
            border-radius: 2px;
            transition: width var(--transition-speed) var(--transition-timing);
        }
        
        .footer h5:hover::after {
            width: 100%;
        }
        }
        
        .footer a {
            color: var(--text-light);
            text-decoration: none;
            transition: all var(--transition-speed) var(--transition-timing);
            font-size: 0.85rem;
            position: relative;
            display: inline-block;
        }
        
        .footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: width var(--transition-speed) var(--transition-timing);
        }
        
        .footer a:hover {
            color: var(--gold-light);
            transform: translateX(4px);
        }
        
        .footer a:hover::after {
            width: 100%;
        }
        
        .footer p {
            color: var(--text-light);
            line-height: 1.6;
            font-size: 0.85rem;
        }
        
        .footer ul li {
            transition: all var(--transition-speed) var(--transition-timing);
        }
        
        .footer ul li:hover {
            transform: translateX(4px);
        }
        
        /* ============================= */
        /* SOCIAL ICONS                 */
        /* ============================= */
        .social-icons { 
            display: flex;
            gap: 12px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transition: all var(--transition-speed) var(--transition-timing);
            font-size: 1rem;
            border: 1px solid rgba(198, 164, 59, 0.2);
        }
        
        .social-icons a:hover {
            background: var(--gold);
            transform: translateY(-4px) scale(1.1);
            border-color: var(--gold);
            box-shadow: 0 6px 16px rgba(198, 164, 59, 0.3);
        }
        
        .social-icons a:hover i {
            color: var(--blue-dark);
        }
        
        /* ============================= */
        /* COPYRIGHT SECTION            */
        /* ============================= */
        .copyright {
            border-top: 1px solid rgba(198, 164, 59, 0.2);
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 0.5px;
        }
        
        /* ============================= */
        /* BACK TO TOP BUTTON            */
        /* ============================= */
        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: var(--blue-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s var(--transition-timing);
            z-index: 1000;
            box-shadow: 0 4px 16px rgba(198, 164, 59, 0.3);
            font-size: 1.2rem;
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: linear-gradient(135deg, white 0%, var(--gold-light) 100%);
            transform: translateY(-6px);
            box-shadow: 0 8px 24px rgba(198, 164, 59, 0.4);
        }
        
        .back-to-top:active {
            transform: translateY(-3px);
        }
        
        /* ============================= */
        /* GOOGLE TRANSLATE HIDE         */
        /* ============================= */
        .goog-te-banner-frame, .skiptranslate { 
            display: none !important;
        }
        
        body { 
            top: 0 !important;
        }

        /* ============================= */
        /* LANGUAGE TOGGLE BUTTON        */
        /* ============================= */
        .lang-toggle {
            cursor: pointer;
            background: rgba(26, 74, 122, 0.8);
            border-radius: 50px;
            padding: 5px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            user-select: none;
            transition: all var(--transition-speed) var(--transition-timing);
            gap: 2px;
        }
        
        .lang-toggle:hover {
            background: rgba(26, 74, 122, 1);
            border-color: rgba(198, 164, 59, 0.5);
        }
        
        .lang-btn {
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all var(--transition-speed) var(--transition-timing);
            pointer-events: none;
            letter-spacing: 0.5px;
        }
        
        .lang-btn.active {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: var(--blue-dark);
            box-shadow: 0 2px 8px rgba(198, 164, 59, 0.3);
        }
        
        .lang-btn.inactive {
            background: transparent;
            color: white;
        }

        /* ============================= */
        /* SEARCH FORM - NAVBAR         */
        /* ============================= */
        .navbar-search-form {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 999px;
            padding: 0.2rem 0.6rem 0.2rem 0.9rem;
            background: rgba(255, 255, 255, 0.08);
            transition: all var(--transition-speed) var(--transition-timing);
            min-width: 140px;
        }
        
        .navbar-search-form:focus-within {
            border-color: rgba(198, 164, 59, 0.7);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 8px rgba(198, 164, 59, 0.2);
        }
        
        .navbar-search-form input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: white;
            font-size: 0.8rem;
            padding: 0.2rem 0;
            min-width: 80px;
        }
        
        .navbar-search-form input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }
        
        .navbar-search-form button {
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0.2rem 0.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed) var(--transition-timing);
            flex-shrink: 0;
        }
        
        .navbar-search-form button:hover {
            color: var(--gold-light);
            transform: scale(1.2);
        }

        /* ============================= */
        /* TOURISM CARD STYLING         */
        /* ============================= */
        .card,
        .feature-card,
        .info-card,
        .service-card,
        .banner-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(247, 242, 229, 0.98) 100%);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.08);
            transition: transform 0.35s var(--transition-timing), box-shadow 0.35s var(--transition-timing);
        }

        .card:hover,
        .feature-card:hover,
        .info-card:hover,
        .service-card:hover,
        .banner-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.14);
        }

        .card-body,
        .feature-card .card-body,
        .info-card .card-body {
            padding: 1.75rem 1.5rem;
        }

        .card-title,
        .feature-card h3,
        .info-card h3,
        .banner-card h3 {
            color: var(--blue-dark);
            letter-spacing: -0.5px;
            margin-bottom: 0.75rem;
        }

        .card-text,
        .feature-card p,
        .info-card p {
            color: #4f4f4f;
            line-height: 1.75;
            margin-bottom: 1rem;
        }

        .card-img-top,
        .feature-card img,
        .banner-card img {
            border-bottom: 1px solid rgba(198, 164, 59, 0.12);
            transition: transform 0.5s ease, filter 0.4s ease, box-shadow 0.4s ease;
        }

        .card:hover .card-img-top,
        .feature-card:hover img,
        .banner-card:hover img {
            transform: scale(1.03);
        }

        .photo-frame,
        .card-img-top,
        .dest-img,
        .story-card img,
        .berita-image img,
        .informasi-image img,
        .search-card-image img,
        .result-card-image img,
        .content-image,
        .about-image img,
        .destinasi-image img,
        .gallery-item img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 22px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
            transition: transform 0.4s ease, filter 0.35s ease, box-shadow 0.35s ease;
        }

        .photo-frame {
            overflow: hidden;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(243,239,226,0.95));
            border: 1px solid rgba(198, 164, 59, 0.16);
        }

        .photo-frame:hover img,
        .story-card:hover img,
        .gallery-item:hover img,
        .dest-img-wrapper:hover .dest-img,
        .berita-image:hover img,
        .search-card:hover .search-card-image img,
        .result-card:hover .result-card-image img {
            transform: scale(1.04);
            filter: brightness(1.05) saturate(1.05);
            box-shadow: 0 24px 55px rgba(0, 0, 0, 0.18);
        }

        .photo-caption {
            color: #3d3d3d;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .section-card {
            position: relative;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(198, 164, 59, 0.18);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.08);
            border-radius: 28px;
        }

        .section-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 28px;
            pointer-events: none;
            background: radial-gradient(circle at top left, rgba(198, 164, 59, 0.12), transparent 40%);
            mix-blend-mode: screen;
        }

        .section-card > *,
        .section-card .row,
        .section-card .col {
            position: relative;
            z-index: 1;
        }

        .decorative-divider {
            width: 72px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 100%);
            margin: 1.5rem auto;
        }

        .bg-soft {
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(243, 239, 226, 0.95));
            border-radius: 26px;
            box-shadow: 0 18px 45px rgba(0,0,0,0.06);
            border: 1px solid rgba(198, 164, 59, 0.12);
        }
        
        /* ============================= */
        /* RESPONSIVE DESIGN - TABLET   */
        /* ============================= */
        @media (max-width: 991px) {
            .navbar .container {
                padding: 0 15px;
                gap: 0.75rem;
            }
            
            .logo-wrapper {
                gap: 10px;
            }
            
            .logo-img {
                height: 36px;
            }
            
            .logo-divider {
                height: 26px;
            }
            
            .navbar-brand {
                font-size: 1.25rem;
            }
            
            .navbar-collapse {
                background: rgba(0, 51, 102, 0.98);
                backdrop-filter: blur(15px);
                padding: 1.2rem;
                border-radius: 16px;
                margin-top: 1rem;
                max-height: 80vh;
                overflow-y: auto;
                border: 1px solid rgba(198, 164, 59, 0.1);
            }
            
            .navbar-nav {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
            }
            
            .nav-item {
                width: 100%;
            }
            
            .nav-link {
                justify-content: center;
                width: 100%;
                padding: 0.8rem !important;
                font-size: 0.95rem;
            }
            
            .nav-link.active {
                border-left: none;
                border-bottom: 3px solid var(--gold);
            }
            
            .dropdown-menu {
                background: rgba(0, 51, 102, 0.9);
                margin: 0.5rem 0;
                min-width: auto;
                width: 100%;
            }
            
            .dropdown-item {
                justify-content: center;
                padding: 10px 15px;
            }
            
            .navbar-search-form {
                width: 100%;
                margin-top: 0.75rem;
                min-width: unset;
            }
            
            .navbar-search-form input {
                min-width: unset;
            }
            
            .lang-toggle {
                width: 100%;
                margin-top: 0.75rem;
                justify-content: center;
            }
        }
        
        /* ============================= */
        /* RESPONSIVE DESIGN - MOBILE   */
        /* ============================= */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.7rem 0;
            }
            
            .navbar .container {
                padding: 0 12px;
            }
            
            .logo-img {
                height: 32px;
            }
            
            .logo-divider {
                height: 24px;
            }
            
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .nav-link {
                font-size: 0.9rem;
            }
        }
        
        /* ============================= */
        /* RESPONSIVE DESIGN - SMALL    */
        /* ============================= */
        @media (max-width: 576px) {
            .navbar {
                padding: 0.6rem 0;
            }
            
            .navbar .container {
                padding: 0 10px;
            }
            
            .logo-wrapper {
                gap: 8px;
            }
            
            .logo-img {
                height: 28px;
            }
            
            .logo-divider {
                height: 20px;
                width: 1.5px;
            }
            
            .navbar-brand {
                font-size: 0.95rem;
                letter-spacing: -1px;
            }
            
            .nav-link {
                font-size: 0.85rem;
                padding: 0.65rem !important;
            }
            
            .navbar-toggler {
                padding: 8px 12px;
            }
            
            .navbar-collapse {
                padding: 1rem;
            }
            
            .navbar-search-form {
                padding: 0.15rem 0.5rem 0.15rem 0.75rem;
                font-size: 0.75rem;
            }
            
            .navbar-search-form input {
                font-size: 0.75rem;
            }
            
            .dropdown-header {
                font-size: 0.65rem;
            }
            
            .dropdown-item {
                font-size: 0.8rem;
                padding: 8px 12px;
            }
            
            .footer h5 {
                font-size: 1rem;
            }
            
            .back-to-top {
                width: 44px;
                height: 44px;
                bottom: 20px;
                right: 20px;
                font-size: 1rem;
            }
        }
        
        /* ============================= */
        /* EXTRA SMALL DEVICES          */
        /* ============================= */
        @media (max-width: 360px) {
            .navbar-brand {
                font-size: 0.85rem;
            }
            
            .nav-link {
                font-size: 0.8rem;
                padding: 0.6rem !important;
            }
            
            .logo-img {
                height: 24px;
            }
            
            .navbar-search-form {
                font-size: 0.7rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Google Translate -->
    <div id="google_translate_element" style="display:none"></div>

    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'en,id',
            autoDisplay: false
        }, 'google_translate_element');
    }

    function translateTo(lang) {
        var select = document.querySelector('.goog-te-combo');
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event('change'));
        }
    }

    var currentLang = 'id';

    function toggleLanguage() {
        if (currentLang === 'id') {
            currentLang = 'en';
            translateTo('en');
            document.getElementById('btnID').className = 'lang-btn inactive';
            document.getElementById('btnEN').className = 'lang-btn active';
        } else {
            currentLang = 'id';
            translateTo('id');
            document.getElementById('btnID').className = 'lang-btn active';
            document.getElementById('btnEN').className = 'lang-btn inactive';
        }
    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <div class="logo-wrapper">
                <img src="{{ asset('uploads/logobankindonesia.jpeg') }}" alt="Bank Indonesia" class="logo-img">
                <div class="logo-divider"></div>
                <img src="{{ asset('uploads/del.jpeg') }}" alt="Logo Del" class="logo-img">
                <div class="logo-divider"></div>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Geo<span>Toba</span>
                </a>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('informasi') ? 'active' : '' }}" href="{{ url('/informasi') }}">
                            <i class="fas fa-info-circle me-1"></i> Informasi
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('destinasi*') ? 'active' : '' }}" 
                           href="#" id="destinasiDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-map-marked-alt me-1"></i> Destinasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="destinasiDropdown">
                            <li><h6 class="dropdown-header">KATEGORI DESTINASI</h6></li>
                            <li><a class="dropdown-item" href="{{ url('/destinasi/alam') }}">Destinasi Alam</a></li>
                            <li><a class="dropdown-item" href="{{ url('/destinasi/buatan') }}">Destinasi Buatan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/destinasi/budaya') }}">Destinasi Budaya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/destinasi') }}">Semua Destinasi</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ url('/galeri') }}">
                            <i class="fas fa-images me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}" href="{{ url('/berita') }}">
                            <i class="fas fa-newspaper me-1"></i> Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ url('/kontak') }}">
                            <i class="fas fa-envelope me-1"></i> Kontak
                        </a>
                    </li>

                    <!-- Search Form -->
                    <li class="nav-item ms-2 d-flex align-items-center">
                        <form class="navbar-search-form" action="{{ url('/search') }}" method="GET">
                            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari..." aria-label="Pencarian">
                            <button type="submit" aria-label="Cari"><i class="fas fa-search"></i></button>
                        </form>
                    </li>

                    <!-- Tombol Bahasa Toggle -->
                    <li class="nav-item ms-2 d-flex align-items-center">
                        <div class="lang-toggle" onclick="toggleLanguage()">
                            <span id="btnID" class="lang-btn active">ID</span>
                            <span id="btnEN" class="lang-btn inactive">EN</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Geo<span style="color: #c6a43b;">Toba</span></h5>
                    <p style="font-size: 0.8rem; color: rgba(255,255,255,0.7);">Sistem Informasi Geosite Danau Toba - Menyajikan informasi lengkap tentang keindahan geologi dan budaya Batak di kawasan Danau Toba.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Tautan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ url('/informasi') }}">Informasi</a></li>
                        <li class="mb-2"><a href="{{ url('/galeri') }}">Galeri</a></li>
                        <li class="mb-2"><a href="{{ url('/berita') }}">Berita</a></li>
                        <li class="mb-2"><a href="{{ url('/kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Destinasi</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/destinasi/alam') }}">Destinasi Alam</a></li>
                        <li class="mb-2"><a href="{{ url('/destinasi/buatan') }}">Destinasi Buatan</a></li>
                        <li class="mb-2"><a href="{{ url('/destinasi/budaya') }}">Destinasi Budaya</a></li>
                        <li class="mb-2"><a href="{{ url('/destinasi') }}">Semua Destinasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2" style="color: #c6a43b;"></i> 
                            Danau Toba, Sumatera Utara
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2" style="color: #c6a43b;"></i> 
                            +62 812 3456 7890
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2" style="color: #c6a43b;"></i> 
                            info@geotoba.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2026 GeoToba - Geopark Danau Toba. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // ===========================
        // Initialize AOS animation
        // ===========================
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 1000,
                    once: true,
                    disable: window.innerWidth < 768 ? 'phone' : false
                });
            }

            // ===========================
            // Navbar scroll effect
            // ===========================
            const navbar = document.getElementById('navbar');
            let scrollTimeout;
            
            window.addEventListener('scroll', function() {
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                }
                
                scrollTimeout = setTimeout(() => {
                    navbar.classList.toggle('scrolled', window.scrollY > 50);
                }, 10);
            });

            // ===========================
            // Back to top functionality
            // ===========================
            const backToTop = document.getElementById('backToTop');
            let backToTopTimeout;
            
            window.addEventListener('scroll', function() {
                if (backToTopTimeout) {
                    clearTimeout(backToTopTimeout);
                }
                
                backToTopTimeout = setTimeout(() => {
                    backToTop.classList.toggle('show', window.scrollY > 300);
                }, 10);
            });
            
            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // ===========================
            // Dropdown animation fix
            // ===========================
            const dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    const menu = this.nextElementSibling;
                    if (menu && menu.classList.contains('dropdown-menu')) {
                        menu.style.animation = 'dropdownSlideIn 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    }
                });
            });

            // ===========================
            // Mobile menu collapse on link click
            // ===========================
            const navLinks = document.querySelectorAll('.navbar-collapse .nav-link:not(.dropdown-toggle)');
            const navbarToggle = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });

            // ===========================
            // Smooth active link highlighting
            // ===========================
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-link');
            
            navItems.forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href) && href !== '/') {
                    link.classList.add('active');
                } else if (href === '/' && currentPath === '/') {
                    link.classList.add('active');
                }
            });

            // ===========================
            // Search form enhancement
            // ===========================
            const searchForm = document.querySelector('.navbar-search-form');
            const searchInput = searchForm ? searchForm.querySelector('input') : null;
            
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        searchForm.submit();
                    }
                });
            }

            // ===========================
            // Improve dropdown accessibility
            // ===========================
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        });

        // ===========================
        // Language toggle functionality
        // ===========================
        let currentLang = localStorage.getItem('currentLang') || 'id';

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'en,id',
                autoDisplay: false
            }, 'google_translate_element');
        }

        function translateTo(lang) {
            const select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
                localStorage.setItem('currentLang', lang);
            }
        }

        function toggleLanguage() {
            if (currentLang === 'id') {
                currentLang = 'en';
                translateTo('en');
                document.getElementById('btnID').className = 'lang-btn inactive';
                document.getElementById('btnEN').className = 'lang-btn active';
            } else {
                currentLang = 'id';
                translateTo('id');
                document.getElementById('btnID').className = 'lang-btn active';
                document.getElementById('btnEN').className = 'lang-btn inactive';
            }
        }

        // Set initial language state on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (currentLang === 'en') {
                document.getElementById('btnID').className = 'lang-btn inactive';
                document.getElementById('btnEN').className = 'lang-btn active';
            } else {
                document.getElementById('btnID').className = 'lang-btn active';
                document.getElementById('btnEN').className = 'lang-btn inactive';
            }
        });

        // ===========================
        // Prevent horizontal scroll
        // ===========================
        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.overflowX = 'hidden';
        });
    </script>
    
    @stack('scripts')
</body>
</html>