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
        html { min-height: 100%; background: var(--bg); }
        body {
            min-height: 100vh;
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Poppins, Inter, ui-sans-serif, system-ui, sans-serif;
            letter-spacing: 0;
        }
        a { color: inherit; text-decoration: none; }
        button, input, textarea, select { font: inherit; }
        button { cursor: pointer; }
        .page-shell { min-height: 100vh; background: #0d0d0d; }
        .topbar {
            height: 96px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 58px;
            background: #0b0b0b;
            border-bottom: 1px solid var(--line);
        }
        .brand { display: flex; align-items: center; gap: 16px; font-weight: 800; font-size: 28px; letter-spacing: 4px; }
        .brand img { width: 56px; height: 56px; object-fit: contain; border-radius: 50%; }
        .brand span { color: var(--accent); }
        .nav { display: flex; gap: 46px; align-items: center; color: var(--muted); font-size: 22px; font-weight: 600; }
        .nav a.active { color: var(--accent); border-bottom: 4px solid var(--accent); padding-bottom: 6px; }
        .account { display: flex; align-items: center; gap: 22px; color: #d6d8df; font-size: 21px; font-weight: 600; }
        .account .divider { width: 1px; height: 34px; background: var(--line); }
        .link-button { background: none; border: 0; color: inherit; padding: 0; font-weight: 600; display: inline-flex; align-items: center; gap: 10px; }
        .container { width: min(1480px, calc(100% - 56px)); margin: 0 auto; padding: 72px 0 86px; }
        .container.narrow { width: min(1180px, calc(100% - 56px)); }
        .eyebrow { color: var(--accent); font-weight: 700; letter-spacing: 9px; text-transform: uppercase; margin: 0 0 14px; }
        h1 { margin: 0; font-size: clamp(40px, 4vw, 72px); line-height: 1.05; font-weight: 800; }
        .lead { margin: 20px 0 0; color: var(--muted); font-size: 23px; line-height: 1.65; }
        .section-line { height: 1px; background: linear-gradient(90deg, rgba(251,255,122,.65), transparent); margin: 36px 0; }
        .header-row { display: flex; justify-content: space-between; gap: 28px; align-items: center; }
        .timer, .stat-card {
            border: 1px solid #3b3b3b;
            background: #242424;
            border-radius: 24px;
            padding: 22px 32px;
            color: var(--muted);
        }
        .timer strong, .stat-card strong { color: #fff; display: block; font-size: 30px; line-height: 1.1; }
        .timer { min-width: 250px; text-align: center; }
        .candidate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        .candidate-card {
            background: #171717;
            border: 1px solid var(--line);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,.22);
            min-height: 740px;
            display: flex;
            flex-direction: column;
        }
        .candidate-cover { height: 310px; background: var(--blue); background-size: cover; background-position: center; }
        .candidate-body { padding: 38px 34px 34px; display: flex; flex-direction: column; flex: 1; }
        .candidate-title { display: flex; gap: 28px; align-items: center; margin-bottom: 20px; }
        .serial { color: var(--accent); font-weight: 800; font-size: 46px; line-height: 1; min-width: 78px; }
        .serial.box { display: grid; place-items: center; width: 96px; height: 96px; min-width: 96px; border-radius: 16px; background: var(--accent); color: #091022; font-size: 34px; }
        .candidate-name { font-size: 23px; font-weight: 700; line-height: 1.35; }
        .candidate-name span { display: block; color: #a8adb7; font-weight: 400; }
        .pills { display: flex; gap: 10px; flex-wrap: wrap; }
        .pill { border: 1px solid #454545; background: #2a2a2a; color: #c7cad1; border-radius: 999px; padding: 4px 18px; font-size: 18px; }
        .mini-label { color: var(--accent); letter-spacing: 3px; text-transform: uppercase; font-weight: 800; margin: 28px 0 14px; }
        .candidate-body p { color: #d2d2d6; font-size: 21px; line-height: 1.68; margin: 0; }
        .primary-btn {
            border: 0;
            border-radius: 15px;
            background: var(--accent);
            color: #091022;
            font-weight: 800;
            font-size: 21px;
            padding: 18px 26px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 0 28px rgba(251,255,122,.22);
        }
        .primary-btn.full { width: 100%; margin-top: auto; }
        .primary-btn.small { font-size: 16px; padding: 12px 18px; border-radius: 10px; }
        .primary-btn:disabled, .primary-btn.disabled { opacity: .45; cursor: not-allowed; box-shadow: none; }
        .notice {
            margin-top: 62px;
            padding: 28px 34px;
            border: 1px solid #3b3b3b;
            border-radius: 22px;
            background: #242424;
            color: var(--muted);
            font-size: 21px;
            line-height: 1.6;
        }
        .detail-card, .content-card {
            border: 1px solid var(--line);
            border-radius: 22px;
            background: #181818;
            overflow: hidden;
        }
        .hero-detail { display: grid; grid-template-columns: 420px 1fr; align-items: stretch; }
        .hero-detail img { width: 100%; height: 365px; object-fit: cover; background: #101010; }
        .hero-copy { padding: 58px; display: flex; flex-direction: column; justify-content: center; }
        .hero-copy h1 { font-size: 44px; margin: 22px 0 8px; }
        .hero-copy .amp { color: var(--muted); font-size: 28px; margin-bottom: 12px; }
        .back-link { display: inline-flex; color: var(--muted); gap: 12px; align-items: center; font-size: 22px; font-weight: 600; margin-bottom: 36px; }
        .text-block { padding: 42px 48px; border-top: 1px solid var(--line); }
        .block-title { display: flex; align-items: center; gap: 16px; font-size: 30px; font-weight: 800; margin-bottom: 28px; }
        .block-title::before { content: ""; width: 6px; height: 40px; border-radius: 6px; background: var(--accent); }
        .text-block p, .text-block li { color: #d0d0d4; font-size: 21px; line-height: 1.7; }
        .program { background: #242424; border: 1px solid #333; border-radius: 18px; padding: 26px 28px; margin-top: 24px; }
        .program h3 { margin: 0 0 8px; font-size: 23px; }
        .program h3::before { content: ""; display: inline-block; width: 12px; height: 12px; margin-right: 18px; border-radius: 50%; background: var(--accent); }
        .warning-box { display: flex; gap: 22px; align-items: flex-start; background: #242424; border: 1px solid #333; border-radius: 18px; padding: 28px; }
        .result-list { display: grid; gap: 28px; }
        .result-card { border: 1px solid var(--line); background: #171717; border-radius: 24px; padding: 38px; }
        .result-card.top { border-color: rgba(251,255,122,.55); box-shadow: inset 0 1px rgba(251,255,122,.4); }
        .result-head { display: flex; justify-content: space-between; gap: 24px; align-items: center; }
        .result-name { display: flex; gap: 28px; align-items: center; }
        .result-name h2 { margin: 0; font-size: 28px; }
        .result-meta { color: var(--muted); margin-top: 8px; font-size: 18px; }
        .percent { text-align: right; font-size: 54px; font-weight: 800; line-height: 1.05; }
        .percent span { display: block; color: var(--muted); font-size: 18px; font-weight: 400; }
        .progress { height: 10px; background: #303025; border-radius: 999px; margin-top: 28px; overflow: hidden; }
        .progress span { display: block; height: 100%; background: var(--accent); border-radius: inherit; }
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-bottom: 34px; }
        .stat-card { background: #171717; padding: 28px 36px; min-height: 128px; }
        .stat-card .label { color: var(--muted); text-transform: uppercase; letter-spacing: 5px; font-size: 17px; font-weight: 700; }
        .stat-card strong { margin-top: 12px; font-size: 34px; }
        .footer { border-top: 1px solid var(--line); padding: 36px 0; color: #69707d; }
        .footer-inner { width: min(1480px, calc(100% - 56px)); margin: 0 auto; display: flex; justify-content: space-between; }
        .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 360px 1fr; background: var(--bg); }
        .sidebar { min-height: 100vh; border-right: 1px solid var(--line); background: #0b0b0b; display: flex; flex-direction: column; }
        .sidebar .brand { height: 112px; padding: 0 34px; border-bottom: 1px solid var(--line); font-size: 28px; letter-spacing: 1px; }
        .admin-profile { display: flex; align-items: center; gap: 22px; height: 145px; padding: 0 34px; border-bottom: 1px solid var(--line); font-size: 22px; font-weight: 800; }
        .avatar { width: 68px; height: 68px; background: #2a2a2a; border-radius: 50%; }
        .side-nav { display: grid; gap: 26px; padding: 36px 22px; }
        .side-nav a { display: flex; align-items: center; gap: 18px; min-height: 78px; padding: 0 24px; border-radius: 8px; color: #969696; font-size: 24px; font-weight: 700; }
        .side-nav a.active { background: var(--accent); color: #080808; }
        .side-logout { margin-top: auto; padding: 28px 90px; border-top: 1px solid var(--line); }
        .admin-main { min-width: 0; }
        .admin-header { min-height: 112px; display: flex; align-items: center; justify-content: space-between; padding: 0 48px; border-bottom: 1px solid var(--line); }
        .admin-header h1 { font-size: 40px; }
        .admin-content { padding: 46px 48px 92px; }
        .table-card { border: 1px solid var(--line); background: #171717; border-radius: 20px; overflow: hidden; }
        .table-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 22px; padding: 28px 38px; border-bottom: 1px solid var(--line); }
        .table-toolbar h2 { margin: 0; font-size: 25px; }
        .table-toolbar p { margin: 6px 0 0; color: var(--dim); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 26px 38px; text-align: left; border-bottom: 1px solid #292929; font-size: 19px; }
        th { color: #7f8492; letter-spacing: 5px; text-transform: uppercase; font-size: 16px; }
        tr:last-child td { border-bottom: 0; }
        .status { display: inline-flex; align-items: center; gap: 8px; border-radius: 10px; padding: 8px 16px; font-weight: 700; }
        .status.success { color: var(--success); background: rgba(34,197,94,.16); border: 1px solid rgba(34,197,94,.45); }
        .status.danger { color: #ff7676; background: rgba(239,68,68,.13); border: 1px solid rgba(239,68,68,.38); }
        .status.warning { color: var(--warning); background: rgba(245,158,11,.13); border: 1px solid rgba(245,158,11,.45); }
        .actions { display: flex; align-items: center; gap: 22px; }
        .action-edit { color: var(--accent); font-weight: 700; }
        .action-delete { color: var(--danger); font-weight: 700; background: none; border: 0; padding: 0; }
        .search { width: min(460px, 100%); border: 2px solid #d6d6dc; border-radius: 18px; padding: 16px 22px; background: transparent; color: #fff; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
        .field { display: grid; gap: 9px; margin-bottom: 18px; }
        .field label { color: #cfd2da; font-weight: 700; }
        .field input, .field textarea, .field select {
            width: 100%;
            border: 1px solid #343434;
            background: #222;
            color: #fff;
            border-radius: 12px;
            padding: 15px 18px;
        }
        .field textarea { min-height: 140px; resize: vertical; }
        .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 24px; }
        .secondary-btn { border: 1px solid #3b3b3b; border-radius: 14px; padding: 15px 22px; color: #d7d7db; background: #242424; font-weight: 700; }
        .choice-row { display: flex; flex-wrap: wrap; gap: 24px; }
        .radio-card { position: relative; min-width: 230px; border: 1px solid #373737; background: #2b2b2b; border-radius: 12px; padding: 20px 26px; font-weight: 800; color: #999; }
        .radio-card input { margin-right: 14px; accent-color: var(--accent); }
        .radio-card:has(input:checked) { color: var(--accent); border: 3px solid var(--accent); background: #28281e; }
        .flash, .error-box { margin-bottom: 22px; border-radius: 14px; padding: 16px 20px; font-weight: 600; }
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
            width: min(630px, calc(100% - 42px));
            border: 1px solid #333;
            border-radius: 30px;
            background: rgba(25,25,25,.86);
            padding: 58px;
            box-shadow: 0 30px 120px rgba(20,32,52,.5);
        }
        .login-card h1 { text-align: center; font-size: 44px; }
        .login-card .lead { text-align: center; margin-top: 10px; font-size: 22px; }
        .input-wrap { position: relative; margin-top: 26px; }
        .input-wrap label { display: block; margin-bottom: 12px; color: #d8dce4; font-weight: 700; font-size: 20px; }
        .input-wrap input {
            width: 100%;
            height: 76px;
            border-radius: 16px;
            border: 1px solid #3e4a5b;
            background: #27313f;
            color: #eef2f8;
            padding: 0 58px;
            font-size: 22px;
        }
        .input-icon { position: absolute; left: 24px; bottom: 24px; color: #8d96a6; }
        .password-toggle { position: absolute; right: 22px; bottom: 22px; background: none; border: 0; color: #8d96a6; font-size: 20px; }
        .remember { display: flex; gap: 12px; color: #b8c3d4; align-items: center; margin: 42px 0 34px; font-size: 18px; }
        .remember input { width: 22px; height: 22px; }
        @media (max-width: 1050px) {
            .candidate-grid, .stats-row, .form-grid { grid-template-columns: 1fr; }
            .topbar { height: auto; padding: 22px; flex-wrap: wrap; gap: 22px; }
            .nav { order: 3; width: 100%; justify-content: center; }
            .hero-detail { grid-template-columns: 1fr; }
            .admin-shell { grid-template-columns: 1fr; }
            .sidebar { min-height: auto; }
            .side-nav { grid-template-columns: repeat(2, 1fr); }
            .side-logout { padding: 24px; }
        }
        @media (max-width: 680px) {
            .brand { font-size: 20px; letter-spacing: 1px; }
            .brand img { width: 42px; height: 42px; }
            .nav, .account { font-size: 16px; gap: 18px; }
            .header-row, .table-toolbar, .result-head { flex-direction: column; align-items: flex-start; }
            .candidate-card { min-height: auto; }
            .candidate-cover { height: 180px; }
            th, td { padding: 18px; font-size: 15px; }
            .admin-header, .admin-content { padding-left: 22px; padding-right: 22px; }
            .login-card { padding: 34px 24px; }
            .side-nav { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
@yield('body')
</body>
</html>
