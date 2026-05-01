<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bandhan Hospital | Advanced Healthcare in Krishnagar, Nadia, West Bengal</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Bandhan Hospital in Krishnagar, Nadia, West Bengal — delivering compassionate, world-class healthcare with advanced diagnostics, emergency care, and specialist consultations." />
    <meta name="keywords"
        content="Bandhan Hospital, Krishnagar hospital, Nadia hospital, West Bengal hospital, best hospital Krishnagar, emergency care Nadia, healthcare Krishnagar" />
    <meta name="author" content="Bandhan Hospital" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://bandhanhospital.in/" />

    <!-- Open Graph -->
    <meta property="og:title" content="Bandhan Hospital | Krishnagar, Nadia" />
    <meta property="og:description"
        content="Advanced, compassionate healthcare for every family. Located at Krishnagar, Nadia, West Bengal." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://bandhanhospital.in/" />

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Hospital",
    "name": "Bandhan Hospital",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Krishnagar",
      "addressLocality": "Nadia",
      "addressRegion": "West Bengal",
      "addressCountry": "IN"
    },
    "telephone": "+91-XXXXXXXXXX",
    "url": "https://bandhanhospital.in",
    "openingHours": "Mo-Su 00:00-24:00",
    "medicalSpecialty": ["Cardiology","Neurology","Orthopedics","Pediatrics","Oncology","Emergency Medicine"]
  }
  </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Outfit:wght@600;700;800&display=swap"
        rel="stylesheet" />

    <style>
        :root {
            --navy: #0a1628;
            --navy-mid: #0f2044;
            --teal: #0d7c66;
            --teal-light: #12a085;
            --gold: #c9a84c;
            --gold-light: #e8c96a;
            --cream: #f8f5ef;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-mid: #4a5568;
            --text-light: #8a9ab5;
            --border: rgba(10, 22, 40, 0.08);
            --shadow-soft: 0 4px 30px rgba(10, 22, 40, 0.08);
            --shadow-deep: 0 20px 60px rgba(10, 22, 40, 0.18);
            --radius: 16px;
            --radius-sm: 8px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--teal);
            border-radius: 3px;
        }

        /* ── TOP BAR ── */
        .topbar {
            background: var(--navy);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.78rem;
            font-weight: 400;
            padding: 8px 0;
            letter-spacing: 0.02em;
        }

        .topbar-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .topbar a {
            color: var(--gold-light);
            text-decoration: none;
        }

        .topbar-right {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .topbar-right span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ── NAV ── */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-soft);
        }

        nav {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 32px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(13, 124, 102, 0.35);
        }

        .logo-icon svg {
            width: 24px;
            height: 24px;
        }

        .logo-text h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1;
        }

        .logo-text p {
            font-size: 0.68rem;
            color: var(--text-light);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 4px;
        }

        .nav-links a {
            display: block;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-mid);
            border-radius: var(--radius-sm);
            transition: all 0.2s;
        }

        .nav-links a:hover {
            color: var(--teal);
            background: rgba(13, 124, 102, 0.06);
        }

        .nav-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-actions a {
            text-decoration: none !important;
        }

        .nav-cta {
            background: var(--teal) !important;
            color: var(--white) !important;
            font-weight: 600 !important;
            padding: 10px 22px !important;
            border-radius: 30px !important;
            box-shadow: 0 4px 14px rgba(13, 124, 102, 0.3) !important;
            transition: all 0.25s !important;
            text-decoration: none !important;
        }

        .nav-cta:hover {
            background: var(--teal-light) !important;
            box-shadow: 0 6px 20px rgba(13, 124, 102, 0.4) !important;
            transform: translateY(-1px);
            text-decoration: none !important;
        }

        .nav-emergency {
            background: #e53e3e !important;
            color: var(--white) !important;
            font-weight: 700 !important;
            padding: 10px 20px !important;
            border-radius: 30px !important;
            font-size: 0.82rem !important;
            letter-spacing: 0.04em;
            animation: pulse-red 2s infinite;
            text-decoration: none !important;
        }

        @keyframes pulse-red {

            0%,
            100% {
                box-shadow: 0 4px 14px rgba(229, 62, 62, 0.3);
            }

            50% {
                box-shadow: 0 4px 24px rgba(229, 62, 62, 0.6);
            }
        }

        .hamburger {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
            padding: 4px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--navy);
            border-radius: 2px;
            transition: 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ── HERO ── */
        .hero {
            position: relative;
            min-height: 94vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #e8f5f2 0%, #f0f8ff 50%, #fef9f0 100%);
            z-index: 0;
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            z-index: 0;
            opacity: 0.04;
            background-image:
                radial-gradient(circle at 2px 2px, var(--navy) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .hero-left {
            position: relative;
            z-index: 2;
            padding: 80px 60px 80px 80px;
            animation: fadeInUp 0.9s ease both;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(13, 124, 102, 0.1);
            color: var(--teal);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 8px 18px;
            border-radius: 30px;
            margin-bottom: 24px;
            border: 1px solid rgba(13, 124, 102, 0.2);
        }

        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--teal);
            border-radius: 50%;
            animation: blink 1.4s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.2
            }
        }

        .hero h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.8rem, 4.5vw, 4.2rem);
            font-weight: 700;
            line-height: 1.1;
            color: var(--navy);
            margin-bottom: 20px;
        }

        .hero h2 em {
            font-style: italic;
            color: var(--teal);
        }

        .hero p {
            font-size: 1.05rem;
            color: var(--text-mid);
            line-height: 1.75;
            max-width: 460px;
            margin-bottom: 36px;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--teal);
            color: var(--white);
            padding: 16px 32px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(13, 124, 102, 0.35);
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--teal-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(13, 124, 102, 0.45);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: var(--navy);
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            border: 2px solid var(--navy);
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: var(--navy);
            color: var(--white);
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 36px;
        }

        .hero-stat h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .hero-stat p {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 4px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .hero-right {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 48px 40px 20px;
            animation: fadeInRight 1s ease 0.2s both;
        }

        .hero-visual {
            position: relative;
            width: 100%;
            max-width: 480px;
        }

        /* ── HERO MEDICAL PANEL ── */
        .hv-panel {
            background: var(--white);
            border-radius: 28px;
            box-shadow: 0 24px 64px rgba(10, 22, 40, 0.14);
            overflow: hidden;
            position: relative;
        }

        .hv-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--teal), #38bdf8, var(--gold));
        }

        .hv-scene {
            padding: 28px 28px 0;
            background: linear-gradient(160deg, #eaf7f4 0%, #f0f9ff 60%, #fef9f0 100%);
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        /* Hospital building SVG backdrop */
        .hv-building {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 340px;
        }

        /* Heartbeat line */
        .hv-ecg {
            position: absolute;
            top: 24px;
            left: 0;
            right: 0;
            height: 50px;
            overflow: visible;
        }

        .hv-ecg-path {
            stroke: var(--teal);
            stroke-width: 2.5;
            fill: none;
            stroke-dasharray: 500;
            stroke-dashoffset: 500;
            animation: drawEcg 2.4s ease forwards 0.6s;
        }

        @keyframes drawEcg {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* Floating info chips on the scene */
        .hv-chip {
            position: absolute;
            background: white;
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 6px 20px rgba(10, 22, 40, 0.1);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--navy);
            animation: chipFloat 3.5s ease-in-out infinite;
            white-space: nowrap;
        }

        .hv-chip-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .hv-chip.c1 {
            top: 20px;
            left: 16px;
            animation-delay: 0s;
        }

        .hv-chip.c2 {
            top: 20px;
            right: 16px;
            animation-delay: 1.2s;
        }

        .hv-chip.c3 {
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation-delay: 0.6s;
        }

        @keyframes chipFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }

        .hv-chip.c3 {
            bottom: 20px;
            left: 50%;
            animation: chipFloat3 3.5s ease-in-out infinite 0.6s;
        }

        @keyframes chipFloat3 {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-7px);
            }
        }

        /* Bottom info row */
        .hv-bottom {
            padding: 20px 24px;
            display: grid;
            grid-template-columns: 1fr 1px 1fr 1px 1fr;
            gap: 0;
            align-items: center;
            border-top: 1px solid var(--border);
        }

        .hv-stat {
            text-align: center;
            padding: 8px 12px;
        }

        .hv-stat .val {
            font-family: 'Outfit', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .hv-stat .lbl {
            font-size: 0.7rem;
            color: var(--text-light);
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 500;
        }

        .hv-divider {
            width: 1px;
            height: 40px;
            background: var(--border);
        }

        /* Quick book bar */
        .hv-book {
            background: var(--navy);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .hv-book-left p {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.55);
        }

        .hv-book-left h4 {
            font-size: 0.92rem;
            font-weight: 600;
            color: white;
            margin-top: 2px;
        }

        .hv-book a {
            background: var(--teal);
            color: white;
            padding: 9px 20px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .hv-book a:hover {
            background: var(--teal-light);
        }

        /* ── MARQUEE ── */
        .marquee-wrap {
            background: var(--navy);
            padding: 14px 0;
            overflow: hidden;
        }

        .marquee-track {
            display: flex;
            gap: 0;
            animation: marquee 28s linear infinite;
            white-space: nowrap;
        }

        .marquee-track span {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.82rem;
            font-weight: 500;
            padding: 0 28px;
            letter-spacing: 0.04em;
        }

        .marquee-track span::after {
            content: '◆';
            color: var(--gold);
            font-size: 0.5rem;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0)
            }

            100% {
                transform: translateX(-50%)
            }
        }

        /* ── SECTIONS ── */
        section {
            padding: 90px 0;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 32px;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 12px;
        }

        .section-tag::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background: var(--teal);
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 3vw, 2.8rem);
            font-weight: 700;
            color: var(--navy);
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .section-sub {
            font-size: 1rem;
            color: var(--text-mid);
            line-height: 1.7;
            max-width: 520px;
        }

        /* ── SERVICES ── */
        .services-bg {
            background: var(--cream);
        }

        .services-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 56px;
            flex-wrap: wrap;
            gap: 24px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .service-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 32px 24px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--border);
        }

        .service-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--teal), var(--gold));
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-deep);
        }

        .service-card:hover::after {
            transform: scaleX(1);
        }

        .service-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(13, 124, 102, 0.1), rgba(13, 124, 102, 0.06));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .service-card:hover .service-icon {
            background: var(--teal);
            transform: scale(1.05);
        }

        .service-card h3 {
            font-size: 1.02rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .service-card p {
            font-size: 0.85rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        .service-arrow {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--teal);
            margin-top: 16px;
            opacity: 0;
            transform: translateX(-8px);
            transition: all 0.3s;
        }

        .service-card:hover .service-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        /* ── WHY US ── */
        .why-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .why-left {}

        .why-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 40px;
        }

        .why-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            padding: 24px;
            background: var(--cream);
            border-radius: var(--radius);
            transition: all 0.3s;
            border: 1px solid transparent;
        }

        .why-item:hover {
            background: white;
            border-color: var(--border);
            box-shadow: var(--shadow-soft);
        }

        .why-item-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 4px 14px rgba(13, 124, 102, 0.25);
        }

        .why-item h4 {
            font-size: 0.98rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 4px;
        }

        .why-item p {
            font-size: 0.85rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        .why-right {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 32px 24px;
            text-align: center;
            border: 1px solid var(--border);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card:nth-child(1)::before {
            background: var(--teal);
        }

        .stat-card:nth-child(2)::before {
            background: var(--gold);
        }

        .stat-card:nth-child(3)::before {
            background: #e53e3e;
        }

        .stat-card:nth-child(4)::before {
            background: #7c3aed;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-deep);
        }

        .stat-card .num {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
            letter-spacing: -0.03em;
        }

        .stat-card .lbl {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .stat-card.dark {
            background: var(--navy);
            border-color: transparent;
        }

        .stat-card.dark .num {
            color: var(--gold-light);
        }

        .stat-card.dark .lbl {
            color: rgba(255, 255, 255, 0.5);
        }

        /* ── DOCTORS ── */
        .doctors-bg {
            background: var(--navy);
        }

        .doctors-bg .section-title {
            color: white;
        }

        .doctors-bg .section-sub {
            color: rgba(255, 255, 255, 0.6);
        }

        .doctors-bg .section-tag {
            color: var(--gold-light);
        }

        .doctors-bg .section-tag::before {
            background: var(--gold-light);
        }

        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
            margin-top: 48px;
        }

        .doctor-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.35s;
        }

        .doctor-card:hover {
            background: rgba(255, 255, 255, 0.09);
            transform: translateY(-6px);
            border-color: var(--teal);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .doctor-avatar {
            height: 200px;
            background: linear-gradient(135deg, rgba(13, 124, 102, 0.3), rgba(10, 22, 40, 0.5));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            position: relative;
        }

        .doctor-avatar-inner {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(13, 124, 102, 0.5), rgba(18, 160, 133, 0.5));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .doctor-dept {
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--teal);
            color: white;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            white-space: nowrap;
            letter-spacing: 0.04em;
        }

        .doctor-info {
            padding: 20px;
        }

        .doctor-info h3 {
            font-size: 1rem;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }

        .doctor-info p {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .doctor-quals {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .qual-tag {
            background: rgba(201, 168, 76, 0.15);
            color: var(--gold-light);
            font-size: 0.72rem;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: 500;
        }

        /* ── APPOINTMENT ── */
        .appt-wrap {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-light) 100%);
            border-radius: 28px;
            padding: 64px;
            position: relative;
            overflow: hidden;
        }

        .appt-wrap::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .appt-wrap::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .appt-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .appt-inner h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .appt-inner p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .contact-pills {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-pill {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 14px;
            padding: 14px 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .contact-pill:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(4px);
        }

        .contact-pill-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .appt-form {
            background: white;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.2);
        }

        .appt-form h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--navy);
            transition: border-color 0.2s;
            outline: none;
            background: var(--cream);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--teal);
            background: white;
            box-shadow: 0 0 0 3px rgba(13, 124, 102, 0.08);
        }

        .form-group textarea {
            resize: none;
            height: 80px;
        }

        .form-submit {
            width: 100%;
            background: var(--navy);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 8px;
        }

        .form-submit:hover {
            background: var(--teal);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(13, 124, 102, 0.35);
        }

        /* ── TESTIMONIALS ── */
        .testi-bg {
            background: var(--cream);
        }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 48px;
        }

        .testi-card {
            background: white;
            border-radius: var(--radius);
            padding: 32px;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .testi-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-deep);
        }

        .stars {
            color: var(--gold);
            font-size: 1rem;
            letter-spacing: 2px;
            margin-bottom: 16px;
        }

        .testi-card p {
            font-size: 0.92rem;
            color: var(--text-mid);
            line-height: 1.75;
            font-style: italic;
            margin-bottom: 24px;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .author-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
        }

        .author-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--navy);
        }

        .author-role {
            font-size: 0.78rem;
            color: var(--text-light);
        }

        /* ── FACILITIES ── */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto auto;
            gap: 20px;
            margin-top: 48px;
        }

        .facility-card {
            background: var(--cream);
            border-radius: var(--radius);
            padding: 32px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
            transition: all 0.3s;
            border: 1px solid var(--border);
        }

        .facility-card:hover {
            background: white;
            box-shadow: var(--shadow-deep);
            transform: translateY(-3px);
        }

        .facility-card.featured {
            grid-column: span 2;
            background: var(--navy);
            color: white;
            border-color: transparent;
        }

        .facility-card.featured h3 {
            color: white;
        }

        .facility-card.featured p {
            color: rgba(255, 255, 255, 0.6);
        }

        .facility-card-icon {
            font-size: 1.8rem;
            min-width: 52px;
            height: 52px;
            background: rgba(13, 124, 102, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .facility-card.featured .facility-card-icon {
            background: rgba(255, 255, 255, 0.1);
        }

        .facility-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .facility-card p {
            font-size: 0.85rem;
            color: var(--text-mid);
            line-height: 1.6;
        }

        /* ── MAP / CONTACT ── */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }

        .info-block {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-item {
            display: flex;
            gap: 18px;
            align-items: flex-start;
            padding: 20px;
            background: var(--cream);
            border-radius: 14px;
            border: 1px solid var(--border);
        }

        .info-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .info-item h4 {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 4px;
        }

        .info-item p,
        .info-item a {
            font-size: 0.95rem;
            color: var(--navy);
            font-weight: 500;
            text-decoration: none;
        }

        .info-item a:hover {
            color: var(--teal);
        }

        .map-container {
            border-radius: var(--radius);
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-soft);
        }

        .map-placeholder {
            height: 320px;
            background: linear-gradient(135deg, #e8f5f2, #d4f0e8);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 2rem;
            color: var(--teal);
        }

        .map-placeholder p {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-mid);
        }

        .map-placeholder a {
            background: var(--teal);
            color: white;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 4px;
            transition: all 0.2s;
        }

        .map-placeholder a:hover {
            background: var(--teal-light);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255, 255, 255, 0.6);
            padding: 64px 0 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 48px;
            padding-bottom: 48px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }

        .footer-brand .tagline {
            font-size: 0.78rem;
            color: var(--gold-light);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .footer-brand p {
            font-size: 0.88rem;
            line-height: 1.75;
            max-width: 300px;
        }

        .footer-accred {
            display: flex;
            gap: 10px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .accred-badge {
            background: rgba(201, 168, 76, 0.15);
            border: 1px solid rgba(201, 168, 76, 0.3);
            color: var(--gold-light);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 4px;
            letter-spacing: 0.04em;
        }

        .footer-col h4 {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: white;
            margin-bottom: 20px;
        }

        .footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.88rem;
            transition: color 0.2s;
        }

        .footer-col ul li a:hover {
            color: var(--teal-light);
        }

        .footer-hours {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .hour-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
        }

        .hour-row .day {
            color: rgba(255, 255, 255, 0.5);
        }

        .hour-row .time {
            color: white;
            font-weight: 500;
        }

        .hour-row.emergency .time {
            color: var(--gold-light);
            font-weight: 700;
        }

        .footer-bottom {
            padding: 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 0.8rem;
        }

        .footer-bottom a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
        }

        .footer-bottom a:hover {
            color: var(--teal-light);
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .social-link:hover {
            background: var(--teal);
            border-color: var(--teal);
        }

        /* ── EMERGENCY FLOAT ── */
        .emergency-float {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
        }

        .emer-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #e53e3e;
            color: white;
            padding: 14px 22px;
            border-radius: 50px;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 24px rgba(229, 62, 62, 0.5);
            animation: pulse-red 2s infinite;
            transition: all 0.2s;
        }

        .emer-btn:hover {
            background: #c53030;
            transform: scale(1.03);
        }

        .whatsapp-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #25D366;
            color: white;
            padding: 14px 22px;
            border-radius: 50px;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 24px rgba(37, 211, 102, 0.4);
            transition: all 0.2s;
        }

        .whatsapp-btn:hover {
            background: #128C7E;
            transform: scale(1.03);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── GALLERY ── */
        .gallery-bg {
            background: var(--navy);
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .gallery-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .g-tab {
            padding: 9px 22px;
            border-radius: 30px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            color: rgba(255, 255, 255, 0.6);
            background: transparent;
            font-family: inherit;
            transition: all 0.25s;
            letter-spacing: 0.03em;
        }

        .g-tab:hover {
            border-color: var(--teal);
            color: var(--teal-light);
        }

        .g-tab.active {
            background: var(--teal);
            border-color: var(--teal);
            color: white;
            box-shadow: 0 4px 14px rgba(13, 124, 102, 0.4);
        }

        /* Masonry-style grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            gap: 16px;
        }

        .g-item {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.35s;
        }

        .g-item:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        /* Spanning rules for visual variety */
        .g-item.tall {
            grid-row: span 2;
        }

        .g-item.wide {
            grid-column: span 2;
        }

        .g-item.big {
            grid-column: span 2;
            grid-row: span 2;
        }

        /* The photo placeholder using SVG */
        .g-photo {
            width: 100%;
            height: 100%;
            min-height: 180px;
            display: block;
            object-fit: cover;
        }

        .g-item.tall .g-photo {
            min-height: 380px;
        }

        .g-item.wide .g-photo {
            min-height: 180px;
        }

        .g-item.big .g-photo {
            min-height: 380px;
        }

        /* Overlay on hover */
        .g-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 22, 40, 0.88) 0%, rgba(10, 22, 40, 0.1) 60%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .g-item:hover .g-overlay {
            opacity: 1;
        }

        .g-overlay-text h4 {
            font-size: 0.92rem;
            font-weight: 600;
            color: white;
            margin-bottom: 3px;
        }

        .g-overlay-text p {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .g-zoom {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(6px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s;
        }

        .g-item:hover .g-zoom {
            opacity: 1;
            transform: scale(1);
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(5, 12, 24, 0.96);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .lightbox.open {
            display: flex;
        }

        .lightbox-inner {
            position: relative;
            max-width: 880px;
            width: 100%;
            animation: lbIn 0.3s ease;
        }

        @keyframes lbIn {
            from {
                opacity: 0;
                transform: scale(0.94);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .lightbox-inner svg,
        .lightbox-inner img {
            width: 100%;
            border-radius: 16px;
            display: block;
            max-height: 80vh;
            object-fit: contain;
        }

        .lb-close {
            position: absolute;
            top: -16px;
            right: -16px;
            width: 40px;
            height: 40px;
            background: var(--teal);
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .lb-close:hover {
            background: #e53e3e;
            transform: scale(1.1);
        }

        .lb-caption {
            text-align: center;
            margin-top: 16px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.88rem;
        }

        .lb-caption strong {
            color: white;
        }

        /* Gallery responsive */
        @media (max-width: 900px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .g-item.big {
                grid-column: span 2;
            }
        }

        @media (max-width: 640px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .g-item.tall,
            .g-item.big {
                grid-row: span 1;
            }

            .g-item.wide,
            .g-item.big {
                grid-column: span 2;
            }

            .g-photo,
            .g-item.tall .g-photo,
            .g-item.big .g-photo {
                min-height: 160px;
            }
        }

        @media (max-width: 1100px) {
            .hero {
                grid-template-columns: 1fr 1fr;
                min-height: auto;
            }

            .hero-left {
                padding: 60px 32px 60px 40px;
            }

            .hero-right {
                padding: 40px 32px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 36px;
            }

            .why-grid {
                gap: 40px;
            }

            .appt-inner {
                gap: 40px;
            }
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .hero-left {
                padding: 56px 40px 40px;
                text-align: center;
            }

            .hero p {
                max-width: 100%;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .hero-right {
                display: none;
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .why-right {
                grid-template-columns: 1fr 1fr;
            }

            .appt-inner {
                grid-template-columns: 1fr;
                gap: 36px;
            }

            .appt-wrap {
                padding: 48px 36px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 32px;
            }

            .facilities-grid {
                grid-template-columns: 1fr 1fr;
            }

            .facility-card.featured {
                grid-column: span 2;
            }

            .doctors-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {

            /* Topbar */
            .topbar-inner {
                flex-direction: column;
                gap: 4px;
                text-align: center;
                padding: 8px 16px;
            }

            .topbar-right {
                justify-content: center;
                flex-wrap: wrap;
                gap: 12px;
            }

            /* Nav */
            nav {
                padding: 0 16px;
                height: 64px;
            }

            .nav-links,
            .nav-actions {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            /* Mobile nav open state */
            .nav-links.open,
            .nav-actions.open {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 64px;
                left: 0;
                right: 0;
                background: white;
                padding: 16px;
                gap: 4px;
                border-bottom: 1px solid var(--border);
                z-index: 999;
                box-shadow: 0 8px 24px rgba(10, 22, 40, 0.1);
            }

            .nav-actions.open {
                top: auto;
                position: relative;
                padding: 0 0 8px;
                border-bottom: none;
                box-shadow: none;
            }

            .nav-actions.open a {
                display: block;
                text-align: center;
                padding: 12px !important;
                border-radius: 10px !important;
            }

            /* Container */
            .container {
                padding: 0 16px;
            }

            section {
                padding: 56px 0;
            }

            /* Hero */
            .hero-left {
                padding: 40px 16px 36px;
            }

            .hero h2 {
                font-size: 2.4rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 12px;
            }

            .btn-primary,
            .btn-outline {
                justify-content: center;
                text-align: center;
            }

            .hero-stats {
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
            }

            /* Services */
            .services-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .services-header p {
                text-align: left;
            }

            .services-grid {
                grid-template-columns: 1fr 1fr;
            }

            /* Why */
            .why-right {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .why-list {
                gap: 12px;
                margin-top: 28px;
            }

            .why-item {
                padding: 16px;
                gap: 14px;
            }

            /* Doctors */
            .doctors-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            /* Appointment */
            .appt-wrap {
                padding: 32px 16px;
                border-radius: 20px;
            }

            .appt-inner {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .appt-inner h2 {
                font-size: 1.9rem;
            }

            .contact-pills {
                gap: 8px;
            }

            /* Form */
            .appt-form {
                padding: 24px 16px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            /* Facilities */
            .facilities-grid {
                grid-template-columns: 1fr;
            }

            .facility-card.featured {
                grid-column: span 1;
            }

            /* Testimonials */
            .testi-grid {
                grid-template-columns: 1fr;
            }

            /* Contact */
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .info-item {
                padding: 14px;
                gap: 12px;
            }

            /* Footer */
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .footer-bottom>div {
                flex-wrap: wrap;
                justify-content: center;
            }

            /* Float buttons */
            .emergency-float {
                bottom: 16px;
                right: 12px;
                gap: 8px;
            }

            .emer-btn,
            .whatsapp-btn {
                padding: 12px 16px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .hero h2 {
                font-size: 2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .doctors-grid {
                grid-template-columns: 1fr;
            }

            .why-right {
                grid-template-columns: 1fr 1fr;
            }

            .logo-text p {
                display: none;
            }

            .topbar {
                display: none;
            }

            .hero-stat h3 {
                font-size: 1.8rem;
            }

            .hero-stats {
                gap: 16px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .appt-inner h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <!-- ── TOP BAR ── -->
    <div class="topbar">
        <div class="topbar-inner">
            <span>📍 Krishnagar, Nadia, West Bengal, India</span>
            <div class="topbar-right">
                <span>🕐 Emergency: 24/7 Open</span>
                <span>📞 <a href="tel:+91XXXXXXXXXX">+91-XXXXXXXXXX</a></span>
            </div>
        </div>
    </div>

    <!-- ── HEADER / NAV ── -->
    <header>
        <nav>
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                </div>
                <div class="logo-text">
                    <h1>Bandhan Hospital</h1>
                    <p>Krishnagar · Nadia</p>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#services">Services</a></li>
                <li><a href="#doctors">Doctors</a></li>
                <li><a href="#facilities">Facilities</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            <div class="nav-actions">
                <a href="/dashboard" class="nav-cta">Hospital Login</a>
            </div>

            <div class="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </nav>
    </header>

    <!-- ── HERO ── -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-pattern"></div>

        <div class="hero-left">
            <div class="hero-badge">✦ Accredited Multi-Specialty Hospital</div>
            <h2>Where Every Life<br>Deserves <em>Expert</em><br>Caring Hands</h2>
            <p>Bandhan Hospital brings world-class medical expertise to the heart of Krishnagar — combining cutting-edge
                technology with genuine compassion for every patient, every day.</p>

            <div class="hero-buttons">
                <a href="#appointment" class="btn-primary">
                    📅 Book Appointment
                </a>
                <a href="#services" class="btn-outline">
                    Explore Services →
                </a>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <h3>15+</h3>
                    <p>Specialties</p>
                </div>
                <div class="hero-stat">
                    <h3>50+</h3>
                    <p>Expert Doctors</p>
                </div>
                <div class="hero-stat">
                    <h3>24/7</h3>
                    <p>Emergency Care</p>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-visual">
                <div class="hv-panel">

                    <!-- Scene with hospital building + ECG + floating chips -->
                    <div class="hv-scene">

                        <!-- ECG heartbeat line across the top -->
                        <svg class="hv-ecg" viewBox="0 0 480 50" preserveAspectRatio="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="hv-ecg-path"
                                d="M0,25 L60,25 L75,25 L85,5 L95,45 L105,10 L115,38 L125,25 L180,25 L195,25 L205,5 L215,45 L225,10 L235,38 L245,25 L300,25 L315,25 L325,5 L335,45 L345,10 L355,38 L365,25 L480,25" />
                        </svg>

                        <!-- Hospital Building SVG -->
                        <svg class="hv-building" viewBox="0 0 340 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Sky backdrop -->
                            <rect width="340" height="200" fill="url(#skyGrad)" rx="0" />
                            <defs>
                                <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#e0f4f0" />
                                    <stop offset="100%" stop-color="#c8eee8" />
                                </linearGradient>
                                <linearGradient id="buildGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#ffffff" />
                                    <stop offset="100%" stop-color="#f0f8f6" />
                                </linearGradient>
                                <linearGradient id="wingGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#f8fffe" />
                                    <stop offset="100%" stop-color="#e8f5f2" />
                                </linearGradient>
                            </defs>

                            <!-- Left wing -->
                            <rect x="20" y="80" width="80" height="120" rx="4" fill="url(#wingGrad)" stroke="#b8ddd8"
                                stroke-width="1" />
                            <!-- Left wing windows row 1 -->
                            <rect x="32" y="94" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.9" />
                            <rect x="62" y="94" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.7" />
                            <rect x="32" y="120" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.8" />
                            <rect x="62" y="120" width="20" height="16" rx="3" fill="#bce8e0" />
                            <rect x="32" y="146" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.6" />
                            <rect x="62" y="146" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.9" />

                            <!-- Right wing -->
                            <rect x="240" y="80" width="80" height="120" rx="4" fill="url(#wingGrad)" stroke="#b8ddd8"
                                stroke-width="1" />
                            <rect x="252" y="94" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.7" />
                            <rect x="282" y="94" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.9" />
                            <rect x="252" y="120" width="20" height="16" rx="3" fill="#bce8e0" />
                            <rect x="282" y="120" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.8" />
                            <rect x="252" y="146" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.9" />
                            <rect x="282" y="146" width="20" height="16" rx="3" fill="#bce8e0" opacity="0.6" />

                            <!-- Main building body -->
                            <rect x="90" y="50" width="160" height="150" rx="6" fill="url(#buildGrad)" stroke="#a8d8d0"
                                stroke-width="1.5" />

                            <!-- Windows main building -->
                            <rect x="106" y="64" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.8" />
                            <rect x="138" y="64" width="22" height="18" rx="3" fill="#9dd8d0" />
                            <rect x="170" y="64" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.7" />
                            <rect x="202" y="64" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.9" />

                            <rect x="106" y="94" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.6" />
                            <rect x="138" y="94" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.9" />
                            <rect x="170" y="94" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.8" />
                            <rect x="202" y="94" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.7" />

                            <rect x="106" y="124" width="22" height="18" rx="3" fill="#9dd8d0" />
                            <rect x="202" y="124" width="22" height="18" rx="3" fill="#9dd8d0" opacity="0.8" />

                            <!-- Entrance arch -->
                            <rect x="143" y="148" width="54" height="52" rx="4" fill="#0d7c66" opacity="0.15" />
                            <rect x="143" y="148" width="54" height="52" rx="4" fill="none" stroke="#0d7c66"
                                stroke-width="1.5" opacity="0.5" />
                            <!-- Door panels -->
                            <rect x="148" y="158" width="20" height="42" rx="2" fill="#0d7c66" opacity="0.12" />
                            <rect x="172" y="158" width="20" height="42" rx="2" fill="#0d7c66" opacity="0.12" />

                            <!-- Red Cross sign on building top -->
                            <rect x="161" y="28" width="18" height="6" rx="3" fill="#e53e3e" />
                            <rect x="167" y="22" width="6" height="18" rx="3" fill="#e53e3e" />

                            <!-- Rooftop details -->
                            <rect x="90" y="46" width="160" height="8" rx="3" fill="#0d7c66" opacity="0.25" />

                            <!-- Ground / path -->
                            <rect x="0" y="194" width="340" height="6" fill="#9dd8d0" opacity="0.4" rx="2" />
                            <rect x="130" y="196" width="80" height="4" fill="#0d7c66" opacity="0.2" />

                            <!-- Flag / sign -->
                            <line x1="170" y1="22" x2="170" y2="2" stroke="#0d7c66" stroke-width="1.5" opacity="0.5" />
                            <polygon points="170,2 186,8 170,14" fill="#0d7c66" opacity="0.4" />

                            <!-- Ambulance parked -->
                            <rect x="22" y="176" width="44" height="20" rx="4" fill="#ffffff" stroke="#0d7c66"
                                stroke-width="1.2" />
                            <rect x="22" y="176" width="14" height="20" rx="4" fill="#e8f5f2" stroke="#0d7c66"
                                stroke-width="1" />
                            <circle cx="30" cy="198" r="4" fill="#444" />
                            <circle cx="58" cy="198" r="4" fill="#444" />
                            <rect x="28" y="181" width="10" height="4" rx="1" fill="#e53e3e" opacity="0.8" />
                            <rect x="42" y="181" width="6" height="2" rx="1" fill="#0d7c66" opacity="0.5" />
                            <rect x="42" y="185" width="6" height="2" rx="1" fill="#0d7c66" opacity="0.5" />

                            <!-- Small tree left -->
                            <ellipse cx="228" cy="172" rx="14" ry="18" fill="#7ec8a4" opacity="0.7" />
                            <rect x="225" y="185" width="6" height="10" rx="2" fill="#5a8a6a" opacity="0.6" />
                        </svg>

                        <!-- Floating info chips -->
                        <div class="hv-chip c1">
                            <div class="hv-chip-dot"
                                style="background:#e53e3e; box-shadow: 0 0 0 3px rgba(229,62,62,0.2);"></div>
                            <span>24/7 Emergency</span>
                        </div>
                        <div class="hv-chip c2">
                            <div class="hv-chip-dot"
                                style="background:#0d7c66; box-shadow: 0 0 0 3px rgba(13,124,102,0.2);"></div>
                            <span>NABH Accredited</span>
                        </div>
                        <div class="hv-chip c3">
                            ⭐ 4.9 &nbsp;·&nbsp; 1200+ Reviews
                        </div>
                    </div>

                    <!-- Stats row -->
                    <div class="hv-bottom">
                        <div class="hv-stat">
                            <div class="val">50+</div>
                            <div class="lbl">Doctors</div>
                        </div>
                        <div class="hv-divider"></div>
                        <div class="hv-stat">
                            <div class="val">15+</div>
                            <div class="lbl">Specialties</div>
                        </div>
                        <div class="hv-divider"></div>
                        <div class="hv-stat">
                            <div class="val">10K+</div>
                            <div class="lbl">Patients</div>
                        </div>
                    </div>

                    <!-- Quick Book bar -->
                    <div class="hv-book">
                        <div class="hv-book-left">
                            <p>Next Available Slot</p>
                            <h4>Today · 10:30 AM</h4>
                        </div>
                        <a href="#appointment">Book Now →</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ── MARQUEE ── -->
    <div class="marquee-wrap">
        <div class="marquee-track">
            <span>24/7 Emergency Services</span>
            <span>Advanced Diagnostic Labs</span>
            <span>NABH Accredited</span>
            <span>Expert Cardiologists</span>
            <span>Dedicated ICU & NICU</span>
            <span>Orthopedic Surgery</span>
            <span>Cancer Care Unit</span>
            <span>Digital X-Ray & MRI</span>
            <span>Pediatric Department</span>
            <span>Ambulance Available</span>
            <span>24/7 Emergency Services</span>
            <span>Advanced Diagnostic Labs</span>
            <span>NABH Accredited</span>
            <span>Expert Cardiologists</span>
            <span>Dedicated ICU & NICU</span>
            <span>Orthopedic Surgery</span>
            <span>Cancer Care Unit</span>
            <span>Digital X-Ray & MRI</span>
            <span>Pediatric Department</span>
            <span>Ambulance Available</span>
        </div>
    </div>

    <!-- ── SERVICES ── -->
    <section class="services-bg" id="services">
        <div class="container">
            <div class="services-header reveal">
                <div>
                    <div class="section-tag">Our Specialties</div>
                    <h2 class="section-title">Comprehensive Medical<br>Care Under One Roof</h2>
                </div>
                <p class="section-sub" style="text-align:right;">From routine check-ups to complex surgeries — our
                    specialists deliver excellence at every step of your healthcare journey.</p>
            </div>

            <div class="services-grid">
                <!-- service cards -->
                <div class="service-card reveal">
                    <div class="service-icon">❤️</div>
                    <h3>Cardiology</h3>
                    <p>Advanced cardiac care including angiography, angioplasty, and heart surgery.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🧠</div>
                    <h3>Neurology</h3>
                    <p>Expert treatment for stroke, epilepsy, migraines, and neurological disorders.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🦴</div>
                    <h3>Orthopedics</h3>
                    <p>Joint replacements, fracture care, sports injuries, and spine surgery.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">👶</div>
                    <h3>Pediatrics</h3>
                    <p>Specialized child healthcare from newborns through adolescence.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🔬</div>
                    <h3>Oncology</h3>
                    <p>Comprehensive cancer screening, treatment, and support services.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🤰</div>
                    <h3>Gynaecology</h3>
                    <p>Maternity care, high-risk pregnancies, and women's health services.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🫁</div>
                    <h3>Pulmonology</h3>
                    <p>Asthma, COPD, and complex respiratory disease management.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
                <div class="service-card reveal">
                    <div class="service-icon">🔎</div>
                    <h3>Diagnostic Lab</h3>
                    <p>State-of-the-art pathology, radiology, and imaging diagnostics.</p>
                    <div class="service-arrow">Learn More →</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── WHY US ── -->
    <section id="about">
        <div class="container">
            <div class="why-grid">
                <div class="why-left reveal">
                    <div class="section-tag">Why Choose Us</div>
                    <h2 class="section-title">Healthcare You Can<br>Trust, Every Time</h2>
                    <p class="section-sub">At Bandhan Hospital, we go beyond treatment. We build lasting relationships
                        founded on trust, expertise, and genuine care for your well-being.</p>

                    <div class="why-list">
                        <div class="why-item">
                            <div class="why-item-icon">🏆</div>
                            <div>
                                <h4>NABH Accredited Excellence</h4>
                                <p>Nationally recognized quality standards ensuring safe and effective patient care at
                                    all levels.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon">🔬</div>
                            <div>
                                <h4>Advanced Medical Technology</h4>
                                <p>Equipped with 3T MRI, digital X-ray, laparoscopy, and the latest surgical
                                    instruments.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon">🤝</div>
                            <div>
                                <h4>Patient-First Philosophy</h4>
                                <p>Every decision, protocol, and interaction is guided by your comfort and recovery.</p>
                            </div>
                        </div>
                        <div class="why-item">
                            <div class="why-item-icon">🚑</div>
                            <div>
                                <h4>Round-the-Clock Emergency</h4>
                                <p>24/7 emergency response team with ambulance services across Krishnagar and Nadia
                                    district.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="why-right reveal">
                    <div class="stat-card">
                        <div class="num">10K+</div>
                        <div class="lbl">Patients Treated</div>
                    </div>
                    <div class="stat-card">
                        <div class="num">50+</div>
                        <div class="lbl">Expert Doctors</div>
                    </div>
                    <div class="stat-card dark">
                        <div class="num">15+</div>
                        <div class="lbl">Departments</div>
                    </div>
                    <div class="stat-card">
                        <div class="num">98%</div>
                        <div class="lbl">Patient Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── DOCTORS ── -->
    <section class="doctors-bg" id="doctors">
        <div class="container">
            <div class="reveal"
                style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:20px;">
                <div>
                    <div class="section-tag">Our Team</div>
                    <h2 class="section-title">Meet Our Expert Doctors</h2>
                    <p class="section-sub">Highly qualified specialists with decades of combined experience, dedicated
                        to delivering the finest medical care in Nadia.</p>
                </div>
                <a href="#appointment" class="btn-primary" style="flex-shrink:0;">View All Doctors →</a>
            </div>

            <div class="doctors-grid">
                <div class="doctor-card reveal">
                    <div class="doctor-avatar">
                        <div class="doctor-avatar-inner">👨‍⚕️</div>
                        <div class="doctor-dept">Cardiology</div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Arnab Chatterjee</h3>
                        <p>Senior Cardiologist · 18 yrs exp.</p>
                        <div class="doctor-quals">
                            <span class="qual-tag">MBBS</span>
                            <span class="qual-tag">MD</span>
                            <span class="qual-tag">DM Cardio</span>
                        </div>
                    </div>
                </div>

                <div class="doctor-card reveal">
                    <div class="doctor-avatar">
                        <div class="doctor-avatar-inner">👩‍⚕️</div>
                        <div class="doctor-dept">Neurology</div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Priyanka Bose</h3>
                        <p>Neurologist · 14 yrs exp.</p>
                        <div class="doctor-quals">
                            <span class="qual-tag">MBBS</span>
                            <span class="qual-tag">MD</span>
                            <span class="qual-tag">DM Neuro</span>
                        </div>
                    </div>
                </div>

                <div class="doctor-card reveal">
                    <div class="doctor-avatar">
                        <div class="doctor-avatar-inner">👨‍⚕️</div>
                        <div class="doctor-dept">Orthopedics</div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Soumya Ghosh</h3>
                        <p>Orthopedic Surgeon · 20 yrs exp.</p>
                        <div class="doctor-quals">
                            <span class="qual-tag">MBBS</span>
                            <span class="qual-tag">MS Ortho</span>
                            <span class="qual-tag">FRCS</span>
                        </div>
                    </div>
                </div>

                <div class="doctor-card reveal">
                    <div class="doctor-avatar">
                        <div class="doctor-avatar-inner">👩‍⚕️</div>
                        <div class="doctor-dept">Gynaecology</div>
                    </div>
                    <div class="doctor-info">
                        <h3>Dr. Rina Mondal</h3>
                        <p>Gynaecologist & Obstetrician · 16 yrs</p>
                        <div class="doctor-quals">
                            <span class="qual-tag">MBBS</span>
                            <span class="qual-tag">MS OBG</span>
                            <span class="qual-tag">FICOG</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── APPOINTMENT ── -->
    <section id="appointment">
        <div class="container">
            <div class="appt-wrap reveal">
                <div class="appt-inner">
                    <div>
                        <h2>Book Your Appointment Today</h2>
                        <p>Don't wait — speak to our specialists at Bandhan Hospital. Easy online booking, flexible
                            slots, and same-day emergency consultations available.</p>

                        <div class="contact-pills">
                            <a href="tel:+91XXXXXXXXXX" class="contact-pill">
                                <div class="contact-pill-icon">📞</div>
                                <div>
                                    <div style="font-size:0.75rem;opacity:0.7;">Call Us</div>
                                    <div>+91-XXXXXXXXXX</div>
                                </div>
                            </a>
                            <a href="https://wa.me/91XXXXXXXXXX" class="contact-pill">
                                <div class="contact-pill-icon">💬</div>
                                <div>
                                    <div style="font-size:0.75rem;opacity:0.7;">WhatsApp</div>
                                    <div>Send us a message</div>
                                </div>
                            </a>
                            <a href="mailto:info@bandhanhospital.in" class="contact-pill">
                                <div class="contact-pill-icon">✉️</div>
                                <div>
                                    <div style="font-size:0.75rem;opacity:0.7;">Email</div>
                                    <div>info@bandhanhospital.in</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="appt-form">
                        <h3>Request Appointment</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Ravi" />
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Kumar" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" placeholder="+91 XXXXX XXXXX" />
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select>
                                <option value="">Select Department</option>
                                <option>Cardiology</option>
                                <option>Neurology</option>
                                <option>Orthopedics</option>
                                <option>Gynaecology</option>
                                <option>Pediatrics</option>
                                <option>Oncology</option>
                                <option>Pulmonology</option>
                                <option>General Medicine</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Preferred Date</label>
                                <input type="date" />
                            </div>
                            <div class="form-group">
                                <label>Preferred Time</label>
                                <select>
                                    <option>Morning (9–12)</option>
                                    <option>Afternoon (12–4)</option>
                                    <option>Evening (4–7)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Brief Complaint</label>
                            <textarea placeholder="Describe your symptoms..."></textarea>
                        </div>
                        <button class="form-submit" onclick="handleSubmit(this)">📅 Confirm Appointment</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FACILITIES ── -->
    <section class="services-bg" id="facilities">
        <div class="container">
            <div class="reveal" style="text-align:center;max-width:600px;margin:0 auto 0;">
                <div class="section-tag" style="justify-content:center;">Infrastructure</div>
                <h2 class="section-title">World-Class Facilities</h2>
                <p class="section-sub" style="margin:0 auto;">Equipped with the best technology and infrastructure to
                    support every aspect of patient care.</p>
            </div>

            <div class="facilities-grid">
                <div class="facility-card featured reveal">
                    <div class="facility-card-icon">🏥</div>
                    <div>
                        <h3>Modern ICU & Critical Care</h3>
                        <p>Our fully equipped Intensive Care Unit and Coronary Care Unit operate round the clock,
                            staffed by trained intensivists and critical care nurses providing life-saving interventions
                            with the latest monitoring equipment.</p>
                    </div>
                </div>
                <div class="facility-card reveal">
                    <div class="facility-card-icon">🧪</div>
                    <div>
                        <h3>Advanced Diagnostics Lab</h3>
                        <p>NABL-accredited laboratory for precise pathology, biochemistry, and microbiology testing.</p>
                    </div>
                </div>
                <div class="facility-card reveal">
                    <div class="facility-card-icon">🔬</div>
                    <div>
                        <h3>3T MRI & CT Scan</h3>
                        <p>High-resolution imaging technology for accurate and fast diagnosis.</p>
                    </div>
                </div>
                <div class="facility-card reveal">
                    <div class="facility-card-icon">👶</div>
                    <div>
                        <h3>NICU — Neonatal Care</h3>
                        <p>Specialized neonatal intensive care for premature and critical newborns.</p>
                    </div>
                </div>
                <div class="facility-card reveal">
                    <div class="facility-card-icon">🔪</div>
                    <div>
                        <h3>Modular Operation Theatres</h3>
                        <p>Laminar airflow OTs with advanced laparoscopic and robotic-assisted capabilities.</p>
                    </div>
                </div>
                <div class="facility-card reveal">
                    <div class="facility-card-icon">🚑</div>
                    <div>
                        <h3>Ambulance Services</h3>
                        <p>Advanced Life Support ambulances on call 24/7 across Krishnagar and Nadia district.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS ── -->
    <section class="testi-bg">
        <div class="container">
            <div class="reveal" style="text-align:center;max-width:560px;margin:0 auto 0;">
                <div class="section-tag" style="justify-content:center;">Patient Stories</div>
                <h2 class="section-title">Words from Those<br>We've Cared For</h2>
            </div>

            <div class="testi-grid">
                <div class="testi-card reveal">
                    <div class="stars">★★★★★</div>
                    <p>"The cardiologists at Bandhan Hospital saved my father's life. The speed of emergency response
                        and professional care was extraordinary. Truly the best in Nadia district."</p>
                    <div class="testi-author">
                        <div class="author-avatar">S</div>
                        <div>
                            <div class="author-name">Subhasish Das</div>
                            <div class="author-role">Cardiac Patient's Son, Krishnagar</div>
                        </div>
                    </div>
                </div>

                <div class="testi-card reveal">
                    <div class="stars">★★★★★</div>
                    <p>"I delivered my baby here and the maternity team was absolutely wonderful. Clean, caring, and
                        world-class. Dr. Mondal guided us perfectly through a high-risk pregnancy."</p>
                    <div class="testi-author">
                        <div class="author-avatar">R</div>
                        <div>
                            <div class="author-name">Riya Biswas</div>
                            <div class="author-role">New Mother, Nadia</div>
                        </div>
                    </div>
                </div>

                <div class="testi-card reveal">
                    <div class="stars">★★★★★</div>
                    <p>"My knee replacement surgery was flawless. Dr. Ghosh and his team's precision is unmatched. I'm
                        walking pain-free again. Thank you Bandhan Hospital!"</p>
                    <div class="testi-author">
                        <div class="author-avatar">P</div>
                        <div>
                            <div class="author-name">Pradip Sarkar</div>
                            <div class="author-role">Orthopedic Patient, Krishnagar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ── PHOTO GALLERY ── -->
    <section class="gallery-bg" id="gallery">
        <div class="container">

            <div class="gallery-header reveal">
                <div class="section-tag" style="justify-content:center; color:var(--gold-light);">
                    <span style="display:block;width:24px;height:2px;background:var(--gold-light);"></span>
                    Our Hospital
                </div>
                <h2 class="section-title" style="color:white;">A Glimpse Inside<br>Bandhan Hospital</h2>
                <p class="section-sub" style="color:rgba(255,255,255,0.55); margin:0 auto;">
                    World-class infrastructure, healing spaces, and dedicated care — see what makes Bandhan Hospital the
                    region's most trusted facility.
                </p>
                <div class="gallery-tabs">
                    <button class="g-tab active" onclick="filterGallery('all',this)">All</button>
                    <button class="g-tab" onclick="filterGallery('facility',this)">Facilities</button>
                    <button class="g-tab" onclick="filterGallery('team',this)">Our Team</button>
                    <button class="g-tab" onclick="filterGallery('ward',this)">Wards & Rooms</button>
                    <button class="g-tab" onclick="filterGallery('equipment',this)">Equipment</button>
                </div>
            </div>

            <div class="gallery-grid reveal" id="galleryGrid">

                <!-- BIG: Reception/Lobby -->
                <div class="g-item big" data-cat="facility" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="g1" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#0f2a3a" />
                                <stop offset="100%" stop-color="#1a4a5a" />
                            </linearGradient>
                        </defs>
                        <rect width="600" height="400" fill="url(#g1)" />
                        <!-- Floor tiles -->
                        <rect x="0" y="300" width="600" height="100" fill="#0d3545" />
                        <line x1="0" y1="300" x2="600" y2="300" stroke="#1a5060" stroke-width="1" />
                        <line x1="100" y1="300" x2="100" y2="400" stroke="#1a5060" stroke-width="0.5" />
                        <line x1="200" y1="300" x2="200" y2="400" stroke="#1a5060" stroke-width="0.5" />
                        <line x1="300" y1="300" x2="300" y2="400" stroke="#1a5060" stroke-width="0.5" />
                        <line x1="400" y1="300" x2="400" y2="400" stroke="#1a5060" stroke-width="0.5" />
                        <line x1="500" y1="300" x2="500" y2="400" stroke="#1a5060" stroke-width="0.5" />
                        <!-- Reception desk -->
                        <rect x="150" y="220" width="300" height="80" rx="6" fill="#0d7c66" opacity="0.9" />
                        <rect x="155" y="225" width="290" height="70" rx="4" fill="#0a6655" />
                        <rect x="170" y="235" width="80" height="40" rx="3" fill="#1a8070" opacity="0.6" />
                        <rect x="260" y="235" width="80" height="40" rx="3" fill="#1a8070" opacity="0.6" />
                        <!-- Cross sign on desk -->
                        <rect x="290" y="238" width="20" height="6" rx="2" fill="white" opacity="0.9" />
                        <rect x="297" y="231" width="6" height="20" rx="2" fill="white" opacity="0.9" />
                        <!-- Ceiling lights -->
                        <ellipse cx="150" cy="60" rx="30" ry="10" fill="#c9a84c" opacity="0.3" />
                        <rect x="148" y="60" width="4" height="240" fill="rgba(201,168,76,0.08)" />
                        <ellipse cx="300" cy="40" rx="40" ry="12" fill="#c9a84c" opacity="0.4" />
                        <rect x="298" y="40" width="4" height="260" fill="rgba(201,168,76,0.1)" />
                        <ellipse cx="450" cy="60" rx="30" ry="10" fill="#c9a84c" opacity="0.3" />
                        <rect x="448" y="60" width="4" height="240" fill="rgba(201,168,76,0.08)" />
                        <!-- Wall art / signage -->
                        <rect x="40" y="80" width="120" height="80" rx="4" fill="rgba(255,255,255,0.05)"
                            stroke="rgba(255,255,255,0.1)" stroke-width="1" />
                        <text x="100" y="118" text-anchor="middle" font-size="11" fill="rgba(255,255,255,0.5)"
                            font-family="sans-serif">BANDHAN</text>
                        <text x="100" y="133" text-anchor="middle" font-size="9" fill="rgba(13,124,102,0.8)"
                            font-family="sans-serif">HOSPITAL</text>
                        <!-- People silhouettes -->
                        <ellipse cx="200" cy="225" rx="12" ry="14" fill="rgba(255,255,255,0.15)" />
                        <rect x="192" y="239" width="16" height="30" rx="4" fill="rgba(255,255,255,0.12)" />
                        <ellipse cx="400" cy="225" rx="12" ry="14" fill="rgba(255,255,255,0.15)" />
                        <rect x="392" y="239" width="16" height="30" rx="4" fill="rgba(255,255,255,0.12)" />
                        <!-- Label -->
                        <rect x="0" y="360" width="600" height="40" fill="rgba(0,0,0,0.3)" />
                        <text x="20" y="385" font-size="13" fill="white" font-family="sans-serif" font-weight="600">Main
                            Reception & Lobby</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>Main Reception & Lobby</h4>
                            <p>Modern, welcoming entrance</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Main Reception & Lobby</span>
                    <span style="display:none" class="lb-desc">Our welcoming reception area designed for patient
                        comfort</span>
                </div>

                <!-- TALL: OT / Operation Theatre -->
                <div class="g-item tall" data-cat="facility" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 440" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="g2" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#1a1a2e" />
                                <stop offset="100%" stop-color="#0a2040" />
                            </linearGradient>
                        </defs>
                        <rect width="280" height="440" fill="url(#g2)" />
                        <!-- OT light -->
                        <ellipse cx="140" cy="80" rx="60" ry="18" fill="#e8c96a" opacity="0.6" />
                        <ellipse cx="140" cy="80" rx="40" ry="12" fill="#e8c96a" opacity="0.5" />
                        <circle cx="140" cy="85" r="25" fill="#fef3c7" opacity="0.4" />
                        <!-- Light rays -->
                        <path d="M100 90 L80 220" stroke="rgba(232,201,106,0.12)" stroke-width="20" />
                        <path d="M140 90 L140 220" stroke="rgba(232,201,106,0.15)" stroke-width="30" />
                        <path d="M180 90 L200 220" stroke="rgba(232,201,106,0.12)" stroke-width="20" />
                        <!-- OT Table -->
                        <rect x="60" y="200" width="160" height="14" rx="4" fill="#2a4a6a" />
                        <rect x="80" y="214" width="120" height="80" rx="6" fill="#1e3a5a" />
                        <rect x="80" y="214" width="120" height="8" rx="3" fill="#2e5a7a" />
                        <!-- Patient on table (abstract) -->
                        <ellipse cx="140" cy="220" rx="18" ry="14" fill="rgba(255,255,255,0.12)" />
                        <rect x="110" y="230" width="60" height="50" rx="6" fill="rgba(255,255,255,0.08)" />
                        <!-- Equipment -->
                        <rect x="20" y="140" width="40" height="100" rx="4" fill="#0d3050" stroke="#1a4a70"
                            stroke-width="1" />
                        <rect x="25" y="148" width="30" height="20" rx="2" fill="#0a7c66" opacity="0.7" />
                        <circle cx="35" cy="200" r="8" fill="none" stroke="#0d7c66" stroke-width="2" opacity="0.8" />
                        <rect x="220" y="140" width="40" height="100" rx="4" fill="#0d3050" stroke="#1a4a70"
                            stroke-width="1" />
                        <rect x="225" y="148" width="30" height="30" rx="2" fill="#1a3a60" opacity="0.8" />
                        <!-- Scrub-suited team silhouettes -->
                        <ellipse cx="80" cy="290" rx="14" ry="12" fill="rgba(255,255,255,0.18)" />
                        <rect x="68" y="302" width="24" height="50" rx="5" fill="rgba(13,124,102,0.5)" />
                        <ellipse cx="200" cy="290" rx="14" ry="12" fill="rgba(255,255,255,0.18)" />
                        <rect x="188" y="302" width="24" height="50" rx="5" fill="rgba(13,124,102,0.5)" />
                        <ellipse cx="140" cy="285" rx="14" ry="12" fill="rgba(255,255,255,0.2)" />
                        <rect x="128" y="297" width="24" height="54" rx="5" fill="rgba(13,124,102,0.6)" />
                        <!-- Label -->
                        <rect x="0" y="408" width="280" height="32" fill="rgba(0,0,0,0.4)" />
                        <text x="14" y="429" font-size="12" fill="white" font-family="sans-serif"
                            font-weight="600">Modular Operation Theatre</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>Operation Theatre</h4>
                            <p>State-of-the-art modular OT</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Modular Operation Theatre</span>
                    <span style="display:none" class="lb-desc">Laminar airflow OTs with advanced surgical
                        equipment</span>
                </div>

                <!-- NORMAL: ICU -->
                <div class="g-item" data-cat="ward" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#0d2235" />
                        <!-- Monitor glow -->
                        <rect x="20" y="20" width="80" height="60" rx="4" fill="#0a1828" stroke="#1a3a55"
                            stroke-width="1" />
                        <rect x="24" y="24" width="72" height="50" rx="2" fill="#0a2a1a" />
                        <!-- ECG on monitor -->
                        <polyline points="26,48 36,48 42,38 48,58 54,44 60,52 66,48 90,48" stroke="#0d7c66"
                            stroke-width="1.5" fill="none" />
                        <!-- Bed -->
                        <rect x="60" y="100" width="160" height="14" rx="3" fill="#1a3550" />
                        <rect x="70" y="114" width="140" height="50" rx="4" fill="#152a40" />
                        <rect x="200" y="80" width="30" height="35" rx="3" fill="#1a3550" />
                        <!-- IV drip stand -->
                        <line x1="240" y1="30" x2="240" y2="130" stroke="#2a4a6a" stroke-width="2" />
                        <rect x="230" y="30" width="20" height="6" rx="2" fill="#1a4a6a" />
                        <ellipse cx="240" cy="55" rx="8" ry="16" fill="rgba(200,230,255,0.2)" stroke="#1a4a7a"
                            stroke-width="1" />
                        <line x1="240" y1="71" x2="240" y2="100" stroke="rgba(200,230,255,0.3)" stroke-width="1" />
                        <!-- Patient silhouette -->
                        <ellipse cx="140" cy="108" rx="16" ry="12" fill="rgba(255,255,255,0.12)" />
                        <rect x="110" y="120" width="60" height="38" rx="4" fill="rgba(255,255,255,0.07)" />
                        <!-- Nurse silhouette -->
                        <ellipse cx="46" cy="108" rx="12" ry="10" fill="rgba(255,255,255,0.15)" />
                        <rect x="36" y="118" width="20" height="38" rx="4" fill="rgba(255,255,255,0.1)" />
                        <rect x="0" y="172" width="280" height="28" fill="rgba(0,0,0,0.35)" />
                        <text x="12" y="191" font-size="11" fill="white" font-family="sans-serif"
                            font-weight="600">Intensive Care Unit (ICU)</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>ICU</h4>
                            <p>24/7 critical care monitoring</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Intensive Care Unit (ICU)</span>
                    <span style="display:none" class="lb-desc">Fully equipped ICU with round-the-clock intensivist
                        care</span>
                </div>

                <!-- NORMAL: MRI -->
                <div class="g-item" data-cat="equipment" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#121a28" />
                        <!-- MRI machine body -->
                        <rect x="50" y="60" width="180" height="100" rx="20" fill="#1a2840" stroke="#2a4a6a"
                            stroke-width="2" />
                        <!-- MRI tunnel -->
                        <ellipse cx="140" cy="110" rx="55" ry="42" fill="#0d1828" />
                        <ellipse cx="140" cy="110" rx="42" ry="32" fill="#0a1220" />
                        <ellipse cx="140" cy="110" rx="30" ry="22" fill="#0d2235" opacity="0.5" />
                        <!-- Glowing rings -->
                        <ellipse cx="140" cy="110" rx="55" ry="42" fill="none" stroke="#0d7c66" stroke-width="1.5"
                            opacity="0.6" />
                        <ellipse cx="140" cy="110" rx="48" ry="36" fill="none" stroke="#0d7c66" stroke-width="1"
                            opacity="0.3" />
                        <!-- Table going in -->
                        <rect x="30" y="104" width="240" height="12" rx="3" fill="#2a3a50" />
                        <!-- Glow effect inside tunnel -->
                        <ellipse cx="140" cy="110" rx="26" ry="18" fill="#0d7c66" opacity="0.08" />
                        <!-- Control panel side -->
                        <rect x="230" y="70" width="30" height="50" rx="4" fill="#1e3050" />
                        <rect x="234" y="76" width="22" height="12" rx="2" fill="#0a7c66" opacity="0.7" />
                        <circle cx="245" cy="102" r="4" fill="#e8c96a" opacity="0.8" />
                        <circle cx="245" cy="112" r="4" fill="#0d7c66" opacity="0.8" />
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.4)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif" font-weight="600">3T
                            MRI Imaging Unit</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>MRI Imaging</h4>
                            <p>High-resolution 3T scanner</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">3T MRI Imaging Unit</span>
                    <span style="display:none" class="lb-desc">Advanced MRI for precise neurological and orthopaedic
                        diagnostics</span>
                </div>

                <!-- WIDE: Doctor Team -->
                <div class="g-item wide" data-cat="team" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 560 200" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="g5" x1="0" y1="0" x2="1" y2="0">
                                <stop offset="0%" stop-color="#0d2a40" />
                                <stop offset="100%" stop-color="#0a1e30" />
                            </linearGradient>
                        </defs>
                        <rect width="560" height="200" fill="url(#g5)" />
                        <!-- Backdrop arches -->
                        <ellipse cx="140" cy="0" rx="100" ry="80" fill="rgba(13,124,102,0.08)" />
                        <ellipse cx="420" cy="0" rx="100" ry="80" fill="rgba(13,124,102,0.08)" />
                        <!-- 5 doctor silhouettes -->
                        <g opacity="0.95">
                            <!-- Doc 1 white coat -->
                            <ellipse cx="80" cy="100" rx="22" ry="20" fill="#e8e0d0" />
                            <rect x="58" y="120" width="44" height="60" rx="8" fill="white" />
                            <rect x="68" y="128" width="24" height="8" rx="2" fill="#0d7c66" opacity="0.5" />
                            <!-- Doc 2 -->
                            <ellipse cx="170" cy="95" rx="22" ry="20" fill="#d4bfa0" />
                            <rect x="148" y="115" width="44" height="65" rx="8" fill="white" />
                            <rect x="158" y="123" width="24" height="8" rx="2" fill="#0d7c66" opacity="0.5" />
                            <!-- Doc 3 (center, taller) -->
                            <ellipse cx="280" cy="88" rx="24" ry="22" fill="#c8a888" />
                            <rect x="256" y="110" width="48" height="70" rx="8" fill="white" />
                            <rect x="266" y="118" width="28" height="8" rx="2" fill="#0d7c66" opacity="0.7" />
                            <rect x="266" y="130" width="20" height="6" rx="2" fill="#c9a84c" opacity="0.6" />
                            <!-- Stethoscope on doc 3 -->
                            <path d="M276 132 Q270 150 278 158 Q286 162 288 155" stroke="#1a3040" stroke-width="2"
                                fill="none" opacity="0.4" />
                            <!-- Doc 4 -->
                            <ellipse cx="390" cy="95" rx="22" ry="20" fill="#ddc8a8" />
                            <rect x="368" y="115" width="44" height="65" rx="8" fill="white" />
                            <rect x="378" y="123" width="24" height="8" rx="2" fill="#0d7c66" opacity="0.5" />
                            <!-- Doc 5 -->
                            <ellipse cx="480" cy="100" rx="22" ry="20" fill="#c8b090" />
                            <rect x="458" y="120" width="44" height="60" rx="8" fill="white" />
                            <rect x="468" y="128" width="24" height="8" rx="2" fill="#0d7c66" opacity="0.5" />
                        </g>
                        <!-- Floor line -->
                        <rect x="0" y="178" width="560" height="2" fill="rgba(255,255,255,0.06)" />
                        <!-- Label -->
                        <rect x="0" y="168" width="560" height="32" fill="rgba(0,0,0,0.35)" />
                        <text x="20" y="190" font-size="13" fill="white" font-family="sans-serif" font-weight="600">Our
                            Expert Medical Team</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>Expert Medical Team</h4>
                            <p>50+ dedicated specialists</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Our Expert Medical Team</span>
                    <span style="display:none" class="lb-desc">50+ highly qualified doctors across 15+
                        specialties</span>
                </div>

                <!-- NORMAL: Private Ward Room -->
                <div class="g-item" data-cat="ward" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#1a2a3a" />
                        <!-- Window with light -->
                        <rect x="170" y="20" width="90" height="80" rx="4" fill="#1e3a55" />
                        <rect x="174" y="24" width="82" height="72" rx="2" fill="#e8f4f0" opacity="0.12" />
                        <!-- Curtain -->
                        <path d="M170 20 Q180 60 172 100" stroke="#2a4a6a" stroke-width="8" fill="none"
                            stroke-linecap="round" />
                        <path d="M258 20 Q248 60 256 100" stroke="#2a4a6a" stroke-width="8" fill="none"
                            stroke-linecap="round" />
                        <!-- Hospital bed -->
                        <rect x="20" y="100" width="160" height="12" rx="3" fill="#2a4060" />
                        <rect x="30" y="112" width="140" height="55" rx="5" fill="#1e3050" />
                        <!-- Pillow -->
                        <rect x="38" y="116" width="50" height="24" rx="6" fill="#2e4a6a" opacity="0.8" />
                        <!-- Blanket -->
                        <rect x="30" y="140" width="140" height="25" rx="4" fill="#0d5040" opacity="0.7" />
                        <!-- Bedside table -->
                        <rect x="190" y="115" width="50" height="52" rx="4" fill="#1e3050" stroke="#2a4060"
                            stroke-width="1" />
                        <rect x="195" y="120" width="40" height="5" rx="1" fill="#0d7c66" opacity="0.4" />
                        <circle cx="215" cy="130" r="8" fill="#e8c96a" opacity="0.4" />
                        <!-- IV stand -->
                        <line x1="20" y1="50" x2="20" y2="112" stroke="#2a4a6a" stroke-width="2" />
                        <ellipse cx="20" cy="65" rx="7" ry="14" fill="rgba(200,240,230,0.2)" stroke="#2a6a5a"
                            stroke-width="1" />
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.4)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif"
                            font-weight="600">Premium Private Ward</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>Private Ward</h4>
                            <p>Comfortable recovery rooms</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Premium Private Ward</span>
                    <span style="display:none" class="lb-desc">Comfortable, well-equipped private rooms for restful
                        recovery</span>
                </div>

                <!-- NORMAL: Lab -->
                <div class="g-item" data-cat="equipment" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#0e1e2e" />
                        <!-- Lab bench -->
                        <rect x="0" y="130" width="280" height="14" rx="2" fill="#1a3040" />
                        <!-- Lab equipment row -->
                        <!-- Microscope -->
                        <rect x="30" y="80" width="30" height="50" rx="4" fill="#1e3a50" />
                        <ellipse cx="45" cy="78" rx="14" ry="8" fill="#2a4a62" />
                        <rect x="42" y="60" width="6" height="22" rx="2" fill="#2a4a62" />
                        <circle cx="45" cy="58" r="7" fill="#1a3a50" stroke="#0d7c66" stroke-width="1.5" />
                        <!-- Test tubes rack -->
                        <rect x="100" y="90" width="60" height="10" rx="2" fill="#2a4060" />
                        <rect x="108" y="70" width="8" height="30" rx="4" fill="rgba(100,200,180,0.4)" stroke="#2a6a5a"
                            stroke-width="1" />
                        <rect x="122" y="74" width="8" height="26" rx="4" fill="rgba(200,100,100,0.4)" stroke="#6a2a3a"
                            stroke-width="1" />
                        <rect x="136" y="72" width="8" height="28" rx="4" fill="rgba(100,150,220,0.4)" stroke="#2a4a8a"
                            stroke-width="1" />
                        <rect x="150" y="68" width="8" height="32" rx="4" fill="rgba(220,200,100,0.4)" stroke="#8a7a2a"
                            stroke-width="1" />
                        <!-- Centrifuge -->
                        <circle cx="220" cy="108" r="22" fill="#1a3050" stroke="#2a4a6a" stroke-width="1.5" />
                        <circle cx="220" cy="108" r="14" fill="#0d2040" />
                        <circle cx="220" cy="108" r="6" fill="#0d7c66" opacity="0.5" />
                        <!-- Glowing screen in background -->
                        <rect x="0" y="30" width="80" height="55" rx="4" fill="#0a1e2e" stroke="#1a3a55"
                            stroke-width="1" />
                        <rect x="4" y="34" width="72" height="46" rx="2" fill="#0a2a1a" />
                        <polyline points="6,56 18,56 24,46 30,66 36,52 42,60 48,56 76,56" stroke="#0d7c66"
                            stroke-width="1.5" fill="none" />
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.4)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif" font-weight="600">NABL
                            Diagnostic Laboratory</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>Diagnostic Lab</h4>
                            <p>NABL-accredited pathology</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">NABL Diagnostic Laboratory</span>
                    <span style="display:none" class="lb-desc">Precision pathology, biochemistry and microbiology
                        testing</span>
                </div>

                <!-- NORMAL: NICU -->
                <div class="g-item" data-cat="ward" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#0f1e30" />
                        <!-- Incubator -->
                        <rect x="60" y="80" width="160" height="80" rx="12" fill="#1a3050" stroke="#2a4a6a"
                            stroke-width="1.5" />
                        <!-- Dome top of incubator -->
                        <ellipse cx="140" cy="80" rx="80" ry="20" fill="#1e3a5a" stroke="#2a4a6a" stroke-width="1" />
                        <!-- Inner glow/warmth -->
                        <ellipse cx="140" cy="120" rx="60" ry="30" fill="#e8c96a" opacity="0.04" />
                        <!-- Baby silhouette inside -->
                        <ellipse cx="140" cy="112" rx="18" ry="14" fill="rgba(255,220,180,0.2)" />
                        <rect x="126" y="120" width="28" height="24" rx="8" fill="rgba(255,220,180,0.12)" />
                        <!-- Porthole circles -->
                        <circle cx="85" cy="120" r="14" fill="none" stroke="#2a4a6a" stroke-width="2" />
                        <circle cx="85" cy="120" r="10" fill="rgba(200,240,230,0.06)" />
                        <circle cx="195" cy="120" r="14" fill="none" stroke="#2a4a6a" stroke-width="2" />
                        <circle cx="195" cy="120" r="10" fill="rgba(200,240,230,0.06)" />
                        <!-- Monitor -->
                        <rect x="20" y="50" width="55" height="40" rx="4" fill="#0a1828" stroke="#1a3050"
                            stroke-width="1" />
                        <polyline points="24,68 30,68 34,62 38,74 42,66 46,70 50,68 72,68" stroke="#0d7c66"
                            stroke-width="1.2" fill="none" />
                        <text x="35" y="84" font-size="7" fill="#e8c96a" font-family="sans-serif"
                            opacity="0.8">36.8°C</text>
                        <!-- Soft pink light wash -->
                        <rect x="60" y="80" width="160" height="80" rx="12" fill="rgba(255,150,150,0.03)" />
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.4)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif"
                            font-weight="600">Neonatal ICU (NICU)</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>NICU</h4>
                            <p>Specialised newborn care</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Neonatal ICU (NICU)</span>
                    <span style="display:none" class="lb-desc">Specialised care for premature and critical
                        newborns</span>
                </div>

                <!-- NORMAL: Pharmacy -->
                <div class="g-item" data-cat="facility" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <rect width="280" height="200" fill="#12202e" />
                        <!-- Shelves backdrop -->
                        <rect x="0" y="40" width="280" height="6" rx="1" fill="#1e3050" />
                        <rect x="0" y="80" width="280" height="6" rx="1" fill="#1e3050" />
                        <rect x="0" y="120" width="280" height="6" rx="1" fill="#1e3050" />
                        <!-- Medicine boxes on shelves - top row -->
                        <rect x="10" y="20" width="22" height="20" rx="3" fill="#0d7c66" opacity="0.8" />
                        <rect x="36" y="22" width="18" height="18" rx="3" fill="#c9a84c" opacity="0.8" />
                        <rect x="58" y="18" width="24" height="22" rx="3" fill="#e53e3e" opacity="0.7" />
                        <rect x="86" y="21" width="20" height="19" rx="3" fill="#3b82f6" opacity="0.7" />
                        <rect x="110" y="19" width="22" height="21" rx="3" fill="#0d7c66" opacity="0.6" />
                        <rect x="136" y="22" width="18" height="18" rx="3" fill="#7c3aed" opacity="0.7" />
                        <rect x="158" y="20" width="22" height="20" rx="3" fill="#e53e3e" opacity="0.6" />
                        <rect x="184" y="22" width="20" height="18" rx="3" fill="#c9a84c" opacity="0.8" />
                        <rect x="208" y="19" width="24" height="21" rx="3" fill="#0d7c66" opacity="0.7" />
                        <rect x="236" y="21" width="18" height="19" rx="3" fill="#3b82f6" opacity="0.6" />
                        <rect x="258" y="20" width="16" height="20" rx="3" fill="#e53e3e" opacity="0.7" />
                        <!-- Mid row -->
                        <rect x="10" y="60" width="20" height="20" rx="3" fill="#3b82f6" opacity="0.7" />
                        <rect x="34" y="58" width="24" height="22" rx="3" fill="#0d7c66" opacity="0.8" />
                        <rect x="62" y="61" width="18" height="19" rx="3" fill="#c9a84c" opacity="0.7" />
                        <rect x="84" y="60" width="22" height="20" rx="3" fill="#7c3aed" opacity="0.6" />
                        <rect x="110" y="58" width="20" height="22" rx="3" fill="#e53e3e" opacity="0.7" />
                        <rect x="134" y="60" width="24" height="20" rx="3" fill="#0d7c66" opacity="0.6" />
                        <rect x="162" y="59" width="20" height="21" rx="3" fill="#c9a84c" opacity="0.8" />
                        <rect x="186" y="61" width="18" height="19" rx="3" fill="#3b82f6" opacity="0.7" />
                        <rect x="208" y="60" width="22" height="20" rx="3" fill="#e53e3e" opacity="0.6" />
                        <rect x="234" y="58" width="20" height="22" rx="3" fill="#7c3aed" opacity="0.7" />
                        <rect x="258" y="60" width="18" height="20" rx="3" fill="#0d7c66" opacity="0.8" />
                        <!-- Counter -->
                        <rect x="0" y="148" width="280" height="52" rx="0" fill="#1a3040" />
                        <rect x="0" y="148" width="280" height="8" rx="0" fill="#0d7c66" opacity="0.5" />
                        <!-- Pharmacist silhouette -->
                        <ellipse cx="200" cy="145" rx="18" ry="16" fill="rgba(255,255,255,0.15)" />
                        <rect x="182" y="161" width="36" height="38" rx="6" fill="white" opacity="0.12" />
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.35)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif"
                            font-weight="600">In-House Pharmacy</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>In-House Pharmacy</h4>
                            <p>24/7 medication dispensing</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">In-House Pharmacy</span>
                    <span style="display:none" class="lb-desc">Round-the-clock pharmacy stocked with all prescribed
                        medications</span>
                </div>

                <!-- NORMAL: Ambulance -->
                <div class="g-item" data-cat="facility" onclick="openLb(this)">
                    <svg class="g-photo" viewBox="0 0 280 200" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="g10" x1="0" y1="1" x2="0" y2="0">
                                <stop offset="0%" stop-color="#0a1828" />
                                <stop offset="100%" stop-color="#1a3040" />
                            </linearGradient>
                        </defs>
                        <rect width="280" height="200" fill="url(#g10)" />
                        <!-- Road -->
                        <rect x="0" y="150" width="280" height="50" fill="#0a1420" />
                        <rect x="0" y="148" width="280" height="4" fill="#1a3040" />
                        <!-- Road markings -->
                        <rect x="20" y="168" width="30" height="4" rx="2" fill="rgba(255,255,255,0.15)" />
                        <rect x="80" y="168" width="30" height="4" rx="2" fill="rgba(255,255,255,0.15)" />
                        <rect x="140" y="168" width="30" height="4" rx="2" fill="rgba(255,255,255,0.15)" />
                        <rect x="200" y="168" width="30" height="4" rx="2" fill="rgba(255,255,255,0.15)" />
                        <!-- Ambulance body -->
                        <rect x="30" y="90" width="190" height="62" rx="8" fill="white" />
                        <rect x="30" y="90" width="50" height="62" rx="8" fill="#f0f0f0" />
                        <!-- Cab section -->
                        <rect x="30" y="100" width="50" height="40" rx="5" fill="#e0e8f0" />
                        <!-- Red cross on body -->
                        <rect x="120" y="104" width="60" height="14" rx="3" fill="#e53e3e" opacity="0.85" />
                        <rect x="143" y="96" width="14" height="30" rx="3" fill="#e53e3e" opacity="0.85" />
                        <!-- Blue stripe -->
                        <rect x="30" y="124" width="190" height="8" fill="#1a4a8a" opacity="0.7" />
                        <!-- Windows -->
                        <rect x="38" y="103" width="34" height="22" rx="4" fill="#b8d4e8" opacity="0.8" />
                        <rect x="200" y="103" width="14" height="16" rx="3" fill="#b8d4e8" opacity="0.6" />
                        <!-- Wheels -->
                        <circle cx="80" cy="152" r="18" fill="#1a2a3a" stroke="#2a3a4a" stroke-width="2" />
                        <circle cx="80" cy="152" r="10" fill="#0a1828" />
                        <circle cx="80" cy="152" r="4" fill="#2a3a4a" />
                        <circle cx="190" cy="152" r="18" fill="#1a2a3a" stroke="#2a3a4a" stroke-width="2" />
                        <circle cx="190" cy="152" r="10" fill="#0a1828" />
                        <circle cx="190" cy="152" r="4" fill="#2a3a4a" />
                        <!-- Siren light -->
                        <rect x="100" y="84" width="50" height="10" rx="4" fill="#e53e3e" opacity="0.9" />
                        <ellipse cx="115" cy="84" rx="8" ry="4" fill="#ff6060" opacity="0.7" />
                        <ellipse cx="135" cy="84" rx="8" ry="4" fill="#6060ff" opacity="0.7" />
                        <!-- AMBULANCE text -->
                        <text x="150" y="116" text-anchor="middle" font-size="9" fill="white" font-family="sans-serif"
                            font-weight="700" letter-spacing="2" opacity="0.9">AMBULANCE</text>
                        <!-- Label -->
                        <rect x="0" y="170" width="280" height="30" fill="rgba(0,0,0,0.4)" />
                        <text x="12" y="190" font-size="11" fill="white" font-family="sans-serif"
                            font-weight="600">Advanced Life Support Ambulance</text>
                    </svg>
                    <div class="g-overlay">
                        <div class="g-overlay-text">
                            <h4>ALS Ambulance</h4>
                            <p>24/7 emergency response</p>
                        </div>
                    </div>
                    <div class="g-zoom">⛶</div>
                    <span style="display:none" class="lb-title">Advanced Life Support Ambulance</span>
                    <span style="display:none" class="lb-desc">Fully equipped ALS ambulances available across Nadia
                        district</span>
                </div>

            </div>
            <!-- end gallery-grid -->
        </div>
    </section>

    <!-- ── LIGHTBOX ── -->
    <div class="lightbox" id="lightbox" onclick="closeLb(event)">
        <div class="lightbox-inner" id="lbInner">
            <button class="lb-close" onclick="closeLb()">✕</button>
            <div id="lbContent"></div>
            <div class="lb-caption">
                <strong id="lbTitle"></strong><br>
                <span id="lbDesc"></span>
            </div>
        </div>
    </div>

    <!-- ── CONTACT & MAP ── -->
    <section id="contact">
        <div class="container">
            <div class="contact-grid">
                <div>
                    <div class="section-tag reveal">Find Us</div>
                    <h2 class="section-title reveal">Visit Bandhan Hospital</h2>
                    <p class="section-sub reveal" style="margin-bottom:32px;">We're conveniently located in the heart of
                        Krishnagar, Nadia — easily accessible from across the district.</p>

                    <div class="info-block">
                        <div class="info-item reveal">
                            <div class="info-icon">📍</div>
                            <div>
                                <h4>Address</h4>
                                <p>Bandhan Hospital, Krishnagar,<br>Nadia, West Bengal, India</p>
                            </div>
                        </div>
                        <div class="info-item reveal">
                            <div class="info-icon">📞</div>
                            <div>
                                <h4>Phone / Emergency</h4>
                                <a href="tel:+91XXXXXXXXXX">+91-XXXXXXXXXX</a>
                            </div>
                        </div>
                        <div class="info-item reveal">
                            <div class="info-icon">✉️</div>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:info@bandhanhospital.in">info@bandhanhospital.in</a>
                            </div>
                        </div>
                        <div class="info-item reveal">
                            <div class="info-icon">🕐</div>
                            <div>
                                <h4>OPD Hours</h4>
                                <p>Mon – Sat: 8:00 AM – 8:00 PM<br>Sunday: 9:00 AM – 2:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="reveal">
                    <div class="map-container">
                        <div class="map-placeholder">
                            <span>🗺️</span>
                            <p><strong>Bandhan Hospital</strong> — Krishnagar, Nadia</p>
                            <p style="font-size:0.82rem;color:#888;">West Bengal, India</p>
                            <a href="https://maps.google.com/?q=Krishnagar+Nadia+West+Bengal" target="_blank"
                                rel="noopener">Open in Google Maps ↗</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h2>Bandhan Hospital</h2>
                    <p class="tagline">Healing with Heart · Krishnagar</p>
                    <p>Your trusted healthcare partner in Nadia, West Bengal. Providing compassionate, expert medical
                        care to families across the region since our founding.</p>
                    <div class="footer-accred">
                        <span class="accred-badge">NABH</span>
                        <span class="accred-badge">NABL Lab</span>
                        <span class="accred-badge">ISO 9001</span>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Our Departments</h4>
                    <ul>
                        <li><a href="#services">Cardiology</a></li>
                        <li><a href="#services">Neurology</a></li>
                        <li><a href="#services">Orthopedics</a></li>
                        <li><a href="#services">Gynaecology</a></li>
                        <li><a href="#services">Pediatrics</a></li>
                        <li><a href="#services">Oncology</a></li>
                        <li><a href="#services">Radiology</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#doctors">Our Doctors</a></li>
                        <li><a href="#facilities">Facilities</a></li>
                        <li><a href="#appointment">Book Appointment</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#">Health Blog</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Visiting Hours</h4>
                    <div class="footer-hours">
                        <div class="hour-row">
                            <span class="day">Monday – Friday</span>
                            <span class="time">8 AM – 8 PM</span>
                        </div>
                        <div class="hour-row">
                            <span class="day">Saturday</span>
                            <span class="time">8 AM – 8 PM</span>
                        </div>
                        <div class="hour-row">
                            <span class="day">Sunday</span>
                            <span class="time">9 AM – 2 PM</span>
                        </div>
                        <div class="hour-row emergency"
                            style="margin-top:8px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.1);">
                            <span class="day" style="color:rgba(255,255,255,0.7);">🚨 Emergency</span>
                            <span class="time">24 / 7</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2025 Bandhan Hospital, Krishnagar, Nadia, West Bengal. All rights reserved.</p>
                <div style="display:flex;gap:24px;align-items:center;">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Disclaimer</a>
                    <div class="social-links">
                        <a href="#" class="social-link">f</a>
                        <a href="#" class="social-link">in</a>
                        <a href="#" class="social-link">▶</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ── EMERGENCY FLOAT ── -->
    <div class="emergency-float">
        <a href="https://wa.me/91XXXXXXXXXX" target="_blank" class="whatsapp-btn">
            💬 WhatsApp Us
        </a>
        <a href="tel:+91XXXXXXXXXX" class="emer-btn">
            🚨 Emergency Call
        </a>
    </div>

    <script>
        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 60);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(el => observer.observe(el));

        // Mobile menu
        function toggleMenu() {
            const nl = document.querySelector('.nav-links');
            const na = document.querySelector('.nav-actions');
            const hb = document.querySelector('.hamburger');
            const isOpen = nl.classList.contains('open');
            if (isOpen) {
                nl.classList.remove('open');
                na.classList.remove('open');
                hb.classList.remove('active');
            } else {
                nl.classList.add('open');
                na.classList.add('open');
                hb.classList.add('active');
            }
        }
        // Close menu when a link is clicked
        document.querySelectorAll('.nav-links a, .nav-actions a').forEach(a => {
            a.addEventListener('click', () => {
                document.querySelector('.nav-links').classList.remove('open');
                document.querySelector('.nav-actions').classList.remove('open');
                document.querySelector('.hamburger').classList.remove('active');
            });
        });

        // Smooth section nav
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const id = a.getAttribute('href');
                if (id.length > 1) {
                    const el = document.querySelector(id);
                    if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth' }); }
                }
            });
        });

        // Form submit
        function handleSubmit(btn) {
            btn.textContent = '✅ Appointment Requested!';
            btn.style.background = 'var(--teal)';
            btn.disabled = true;
            setTimeout(() => {
                btn.textContent = '📅 Confirm Appointment';
                btn.style.background = '';
                btn.disabled = false;
            }, 3500);
        }

        // Gallery filter
        function filterGallery(cat, btn) {
            document.querySelectorAll('.g-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.g-item').forEach(item => {
                const match = cat === 'all' || item.dataset.cat === cat;
                item.style.display = match ? '' : 'none';
            });
        }

        // Lightbox
        function openLb(item) {
            const svg = item.querySelector('svg').cloneNode(true);
            svg.style.cssText = 'width:100%;border-radius:12px;display:block;max-height:75vh;';
            const title = item.querySelector('.lb-title').textContent;
            const desc = item.querySelector('.lb-desc').textContent;
            document.getElementById('lbContent').innerHTML = '';
            document.getElementById('lbContent').appendChild(svg);
            document.getElementById('lbTitle').textContent = title;
            document.getElementById('lbDesc').textContent = desc;
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeLb(e) {
            if (!e || e.target === document.getElementById('lightbox') || e.target.classList.contains('lb-close')) {
                document.getElementById('lightbox').classList.remove('open');
                document.body.style.overflow = '';
            }
        }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLb({ target: document.getElementById('lightbox') }); });
        function animateCounters() {
            document.querySelectorAll('.num').forEach(el => {
                const target = parseFloat(el.textContent);
                if (isNaN(target)) return;
                const suffix = el.textContent.replace(/[\d.]/g, '');
                let start = 0;
                const dur = 1400;
                const step = (timestamp) => {
                    if (!start) start = timestamp;
                    const progress = Math.min((timestamp - start) / dur, 1);
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(eased * target) + suffix;
                    if (progress < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            });
        }
        const statsSection = document.querySelector('.why-right');
        if (statsSection) {
            const so = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) { animateCounters(); so.disconnect(); }
            }, { threshold: 0.5 });
            so.observe(statsSection);
        }
    </script>
</body>

</html>