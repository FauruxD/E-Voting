<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BEM E-Voting')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0d0d0d;
            --panel: #171717;
            --panel-2: #202020;
            --line: #2c2c2c;
            --muted: #9ca3af;
            --dim: #6b7280;
            --text: #f7f7f7;
            --accent: #fbff7a;
            --accent-2: #e8f06a;
            --danger: #ff6b72;
            --success: #31d872;
            --warning: #f6b524;
            --blue: #1f2d44;
        }

        * { box-sizing: border-box; }
        html { min-height: 100%; background: var(--bg); font-size: 16px; }
        body {
            min-height: 100vh;
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Poppins, Inter, ui-sans-serif, system-ui, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            letter-spacing: 0;
        }
        a { color: inherit; text-decoration: none; }
        button, input, textarea, select { font: inherit; }
        button { cursor: pointer; }
        .page-shell { min-height: 100vh; background: #0d0d0d; }
        .topbar {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            background: #0b0b0b;
            border-bottom: 1px solid var(--line);
        }
        .brand { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 20px; letter-spacing: 2px; }
        .brand img { width: 38px; height: 38px; object-fit: contain; border-radius: 50%; }
        .brand span { color: var(--accent); }
        .nav { display: flex; gap: 28px; align-items: center; color: var(--muted); font-size: 15px; font-weight: 600; }
        .nav a.active { color: var(--accent); border-bottom: 3px solid var(--accent); padding-bottom: 5px; }
        .account { display: flex; align-items: center; gap: 14px; color: #d6d8df; font-size: 14px; font-weight: 600; }
        .account .divider { width: 1px; height: 24px; background: var(--line); }
        .link-button { background: none; border: 0; color: inherit; padding: 0; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; }
        .container { width: min(1180px, calc(100% - 32px)); margin: 0 auto; padding: 40px 0 52px; }
        .container.narrow { width: min(960px, calc(100% - 32px)); }
        .eyebrow { color: var(--accent); font-weight: 700; letter-spacing: 5px; text-transform: uppercase; margin: 0 0 8px; font-size: 12px; }
        h1 { margin: 0; font-size: clamp(28px, 3vw, 40px); line-height: 1.12; font-weight: 800; }
        .lead { margin: 12px 0 0; color: var(--muted); font-size: 16px; line-height: 1.6; }
        .section-line { height: 1px; background: linear-gradient(90deg, rgba(251,255,122,.65), transparent); margin: 24px 0; }
        .header-row { display: flex; justify-content: space-between; gap: 24px; align-items: center; }
        .timer, .stat-card {
            border: 1px solid #3b3b3b;
            background: #242424;
            border-radius: 14px;
            padding: 16px 20px;
            color: var(--muted);
        }
        .timer strong, .stat-card strong { color: #fff; display: block; font-size: 24px; line-height: 1.1; }
        .timer { min-width: 190px; text-align: center; font-size: 13px; }
        .candidate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .candidate-card {
            background: #171717;
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 18px 48px rgba(0,0,0,.2);
            min-height: 520px;
            display: flex;
            flex-direction: column;
        }
        .candidate-cover { height: 190px; background: var(--blue); background-size: cover; background-position: center; }
        .candidate-body { padding: 22px; display: flex; flex-direction: column; flex: 1; }
        .candidate-title { display: flex; gap: 16px; align-items: center; margin-bottom: 14px; }
        .serial { color: var(--accent); font-weight: 800; font-size: 30px; line-height: 1; min-width: 48px; }
        .serial.box { display: grid; place-items: center; width: 58px; height: 58px; min-width: 58px; border-radius: 12px; background: var(--accent); color: #091022; font-size: 22px; }
        .candidate-name { font-size: 17px; font-weight: 700; line-height: 1.35; }
        .candidate-name span { display: block; color: #a8adb7; font-weight: 400; }
        .pills { display: flex; gap: 8px; flex-wrap: wrap; }
        .pill { border: 1px solid #454545; background: #2a2a2a; color: #c7cad1; border-radius: 999px; padding: 4px 12px; font-size: 13px; }
        .mini-label { color: var(--accent); letter-spacing: 2px; text-transform: uppercase; font-weight: 800; margin: 18px 0 10px; font-size: 13px; }
        .candidate-body p { color: #d2d2d6; font-size: 14px; line-height: 1.65; margin: 0; }
        .primary-btn {
            border: 0;
            border-radius: 10px;
            background: var(--accent);
            color: #091022;
            font-weight: 800;
            font-size: 14px;
            padding: 10px 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 0 20px rgba(251,255,122,.16);
        }
        .primary-btn.full { width: 100%; margin-top: auto; }
        .primary-btn.small { font-size: 13px; padding: 9px 14px; border-radius: 9px; }
        .primary-btn:disabled, .primary-btn.disabled { opacity: .45; cursor: not-allowed; box-shadow: none; }
        .notice {
            margin-top: 32px;
            padding: 18px 20px;
            border: 1px solid #3b3b3b;
            border-radius: 14px;
            background: #242424;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }
        .detail-card, .content-card {
            border: 1px solid var(--line);
            border-radius: 16px;
            background: #181818;
            overflow: hidden;
        }
        .hero-detail { display: grid; grid-template-columns: 320px 1fr; align-items: stretch; }
        .hero-detail img { width: 100%; height: 275px; object-fit: cover; background: #101010; }
        .hero-copy { padding: 34px; display: flex; flex-direction: column; justify-content: center; }
        .hero-copy h1 { font-size: 32px; margin: 16px 0 6px; }
        .hero-copy .amp { color: var(--muted); font-size: 20px; margin-bottom: 8px; }
        .back-link { display: inline-flex; color: var(--muted); gap: 8px; align-items: center; font-size: 15px; font-weight: 600; margin-bottom: 24px; }
        .text-block { padding: 26px 32px; border-top: 1px solid var(--line); }
        .block-title { display: flex; align-items: center; gap: 12px; font-size: 22px; font-weight: 800; margin-bottom: 18px; }
        .block-title::before { content: ""; width: 5px; height: 28px; border-radius: 6px; background: var(--accent); }
        .text-block p, .text-block li { color: #d0d0d4; font-size: 15px; line-height: 1.7; }
        .program { background: #242424; border: 1px solid #333; border-radius: 12px; padding: 18px 20px; margin-top: 16px; }
        .program h3 { margin: 0 0 6px; font-size: 16px; }
        .program h3::before { content: ""; display: inline-block; width: 8px; height: 8px; margin-right: 12px; border-radius: 50%; background: var(--accent); }
        .warning-box { display: flex; gap: 16px; align-items: flex-start; background: #242424; border: 1px solid #333; border-radius: 12px; padding: 18px; }
        .result-list { display: grid; gap: 20px; }
        .result-card { border: 1px solid var(--line); background: #171717; border-radius: 16px; padding: 24px; }
        .result-card.top { border-color: rgba(251,255,122,.55); box-shadow: inset 0 1px rgba(251,255,122,.4); }
        .result-head { display: flex; justify-content: space-between; gap: 18px; align-items: center; }
        .result-name { display: flex; gap: 16px; align-items: center; }
        .result-name h2 { margin: 0; font-size: 20px; }
        .result-meta { color: var(--muted); margin-top: 6px; font-size: 13px; }
        .percent { text-align: right; font-size: 32px; font-weight: 800; line-height: 1.05; }
        .percent span { display: block; color: var(--muted); font-size: 13px; font-weight: 400; }
        .progress { height: 8px; background: #303025; border-radius: 999px; margin-top: 20px; overflow: hidden; }
        .progress span { display: block; height: 100%; background: var(--accent); border-radius: inherit; }
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px; }
        .stat-card { background: #171717; padding: 20px; min-height: 96px; }
        .stat-card .label { color: var(--muted); text-transform: uppercase; letter-spacing: 3px; font-size: 12px; font-weight: 700; }
        .stat-card strong { margin-top: 8px; font-size: 28px; }
        .footer { border-top: 1px solid var(--line); padding: 22px 0; color: #69707d; font-size: 13px; }
        .footer-inner { width: min(1180px, calc(100% - 32px)); margin: 0 auto; display: flex; justify-content: space-between; }
        .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 256px 1fr; background: var(--bg); }
        .sidebar { min-height: 100vh; border-right: 1px solid var(--line); background: #0b0b0b; display: flex; flex-direction: column; }
        .sidebar .brand { height: 72px; padding: 0 24px; border-bottom: 1px solid var(--line); font-size: 20px; letter-spacing: 1px; }
        .admin-profile { display: flex; align-items: center; gap: 14px; height: 96px; padding: 0 24px; border-bottom: 1px solid var(--line); font-size: 15px; font-weight: 800; }
        .avatar { width: 48px; height: 48px; background: #2a2a2a; border-radius: 50%; }
        .side-nav { display: grid; gap: 10px; padding: 22px 16px; }
        .side-nav a { display: flex; align-items: center; gap: 12px; min-height: 46px; padding: 0 14px; border-radius: 10px; color: #969696; font-size: 15px; font-weight: 700; }
        .side-nav a.active { background: var(--accent); color: #080808; }
        .side-logout { margin-top: auto; padding: 18px 28px; border-top: 1px solid var(--line); }
        .admin-main { min-width: 0; }
        .admin-header { min-height: 72px; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; border-bottom: 1px solid var(--line); }
        .admin-header h1 { font-size: 30px; }
        .admin-content { padding: 28px; }
        .table-card { border: 1px solid var(--line); background: #171717; border-radius: 14px; overflow: hidden; }
        .table-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 20px 24px; border-bottom: 1px solid var(--line); }
        .table-toolbar h2 { margin: 0; font-size: 18px; }
        .table-toolbar p { margin: 4px 0 0; color: var(--dim); font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 20px; text-align: left; border-bottom: 1px solid #292929; font-size: 14px; }
        th { color: #7f8492; letter-spacing: 2px; text-transform: uppercase; font-size: 11px; }
        tr:last-child td { border-bottom: 0; }
        .status { display: inline-flex; align-items: center; gap: 6px; border-radius: 999px; padding: 5px 10px; font-size: 12px; font-weight: 700; }
        .status.success { color: var(--success); background: rgba(34,197,94,.16); border: 1px solid rgba(34,197,94,.45); }
        .status.danger { color: #ff7676; background: rgba(239,68,68,.13); border: 1px solid rgba(239,68,68,.38); }
        .status.warning { color: var(--warning); background: rgba(245,158,11,.13); border: 1px solid rgba(245,158,11,.45); }
        .actions { display: flex; align-items: center; gap: 14px; }
        .action-edit { color: var(--accent); font-weight: 700; }
        .action-delete { color: var(--danger); font-weight: 700; background: none; border: 0; padding: 0; }
        .search { width: min(320px, 100%); border: 1px solid #d6d6dc; border-radius: 10px; padding: 9px 12px; background: transparent; color: #fff; font-size: 14px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
        .field { display: grid; gap: 7px; margin-bottom: 16px; }
        .field label { color: #cfd2da; font-weight: 700; font-size: 14px; }
        .field input, .field textarea, .field select {
            width: 100%;
            border: 1px solid #343434;
            background: #222;
            color: #fff;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
        }
        .field textarea { min-height: 110px; resize: vertical; }
        .form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 20px; }
        .secondary-btn { border: 1px solid #3b3b3b; border-radius: 10px; padding: 10px 16px; color: #d7d7db; background: #242424; font-size: 14px; font-weight: 700; }
        .choice-row { display: flex; flex-wrap: wrap; gap: 14px; }
        .radio-card { position: relative; min-width: 160px; border: 1px solid #373737; background: #2b2b2b; border-radius: 10px; padding: 13px 16px; font-size: 14px; font-weight: 800; color: #999; }
        .radio-card input { margin-right: 10px; accent-color: var(--accent); }
        .radio-card:has(input:checked) { color: var(--accent); border: 2px solid var(--accent); background: #28281e; }
        .flash, .error-box { margin-bottom: 18px; border-radius: 10px; padding: 12px 14px; font-size: 14px; font-weight: 600; }
        .flash { background: rgba(34,197,94,.12); color: var(--success); border: 1px solid rgba(34,197,94,.4); }
        .error-box { background: rgba(239,68,68,.12); color: #ff8b8b; border: 1px solid rgba(239,68,68,.4); }
        .login-page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background:
                linear-gradient(180deg, #090909 0 11%, #222 11% 11.4%, transparent 11.4%),
                radial-gradient(circle at 50% 56%, rgba(30,42,60,.46), transparent 22%),
                #090909;
            border-bottom: 8px solid #222;
        }
        .login-card {
            width: min(420px, calc(100% - 32px));
            border: 1px solid #333;
            border-radius: 20px;
            background: rgba(25,25,25,.86);
            padding: 32px;
            box-shadow: 0 22px 90px rgba(20,32,52,.42);
        }
        .login-card h1 { text-align: center; font-size: 28px; }
        .login-card .lead { text-align: center; margin-top: 8px; font-size: 15px; }
        .input-wrap { position: relative; margin-top: 20px; }
        .input-wrap label { display: block; margin-bottom: 8px; color: #d8dce4; font-weight: 700; font-size: 14px; }
        .input-wrap input {
            width: 100%;
            height: 46px;
            border-radius: 10px;
            border: 1px solid #3e4a5b;
            background: #27313f;
            color: #eef2f8;
            padding: 0 44px;
            font-size: 14px;
        }
        .input-icon { position: absolute; left: 18px; bottom: 13px; color: #8d96a6; font-size: 14px; }
        .password-toggle { position: absolute; right: 14px; bottom: 11px; background: none; border: 0; color: #8d96a6; font-size: 16px; }
        .remember { display: flex; gap: 10px; color: #b8c3d4; align-items: center; margin: 24px 0 22px; font-size: 14px; }
        .remember input { width: 16px; height: 16px; }
        @media (max-width: 1050px) {
            .candidate-grid { grid-template-columns: repeat(2, 1fr); }
            .stats-row, .form-grid { grid-template-columns: 1fr; }
            .topbar { height: auto; padding: 16px; flex-wrap: wrap; gap: 16px; }
            .nav { order: 3; width: 100%; justify-content: center; }
            .hero-detail { grid-template-columns: 1fr; }
            .admin-shell { grid-template-columns: 1fr; }
            .sidebar { min-height: auto; }
            .side-nav { grid-template-columns: repeat(2, 1fr); }
            .side-logout { padding: 16px 24px; }
        }
        @media (max-width: 680px) {
            .brand { font-size: 17px; letter-spacing: 1px; }
            .brand img { width: 34px; height: 34px; }
            .nav, .account { font-size: 13px; gap: 14px; }
            .header-row, .table-toolbar, .result-head { flex-direction: column; align-items: flex-start; }
            .candidate-grid { grid-template-columns: 1fr; }
            .candidate-card { min-height: auto; }
            .candidate-cover { height: 160px; }
            th, td { padding: 12px; font-size: 13px; }
            .admin-header, .admin-content { padding-left: 16px; padding-right: 16px; }
            .login-card { padding: 26px 22px; }
            .side-nav { grid-template-columns: 1fr; }
            .footer-inner { flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body>
@yield('body')
</body>
</html>
