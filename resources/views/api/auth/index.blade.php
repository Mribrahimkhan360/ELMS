<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LeaveSync — Login</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS v4.1 browser CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @import "tailwindcss";
        @theme {
            --font-sans: 'DM Sans', sans-serif;
            --font-display: 'DM Serif Display', serif;

            --color-navy:               #1a1f2e;
            --color-navy-hover:         #2d3555;
            --color-accent:             #4a6cf7;
            --color-accent-ring:        rgba(74,108,247,0.12);
            --color-accent-bg:          rgba(74,108,247,0.15);
            --color-accent-tag:         rgba(74,108,247,0.2);

            --color-surface:            #faf9f7;
            --color-border:             #e2ddd8;
            --color-border-soft:        #e8e4de;
            --color-placeholder:        #b4b0aa;
            --color-page-bg:            #f0ede8;

            --color-sidebar-text:       #a8b5d6;
            --color-sidebar-dim:        #7a87a8;
            --color-sidebar-mid:        #8892aa;
            --color-sidebar-label:      #4d5570;
            --color-sidebar-glass:      rgba(255,255,255,0.06);
            --color-sidebar-glass-b:    rgba(255,255,255,0.09);

            --radius-card:  20px;
            --radius-input: 10px;
            --radius-stat:  12px;
            --radius-pill:  9999px;
        }

        /* ── Reset / Base ── */
        *, *::before, *::after { box-sizing: border-box; }

        body {

        }

        /* ── Card wrapper ── */
        .card {
            background: #fff;
            border: 1px solid rgba(0,0,0,0.09);
            border-radius: var(--radius-card);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06), 0 24px 48px rgba(0,0,0,0.06);
        }



        .accent-pill {
            display: inline-block;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: var(--radius-pill);
            color: var(--color-sidebar-text);
            font-size: 0.75rem;
            padding: 4px 12px;
        }

        .stat-box {
            background: var(--color-sidebar-glass);
            border: 1px solid var(--color-sidebar-glass-b);
            border-radius: var(--radius-stat);
            padding: 14px 16px;
        }

        /* ── Inputs ── */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px 14px;
            font-size: 0.875rem;
            font-family: var(--font-sans);
            color: var(--color-navy);
            background: var(--color-surface);
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-input);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        }
        input[type="email"]::placeholder,
        input[type="password"]::placeholder { color: var(--color-placeholder); }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--color-accent);
            background: #fff;
            box-shadow: 0 0 0 3px var(--color-accent-ring);
        }

        /* ── Buttons ── */
        .btn-primary {
            width: 100%;
            padding: 12px 24px;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: var(--font-sans);
            color: #fff;
            background: var(--color-navy);
            border: none;
            border-radius: var(--radius-input);
            cursor: pointer;
            letter-spacing: 0.01em;
            transition: background 0.15s, transform 0.1s;
        }
        .btn-primary:hover { background: var(--color-navy-hover); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }

        .btn-sso {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 0.8125rem;
            font-weight: 500;
            font-family: var(--font-sans);
            color: #444;
            background: var(--color-surface);
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-input);
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
        }
        .btn-sso:hover { border-color: var(--color-placeholder); background: #f4f2ee; }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--color-placeholder);
            font-size: 0.75rem;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-border-soft);
        }

        /* ── Mini calendar ── */
        .mini-calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 3px;
        }
        .cal-day {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.625rem;
            color: var(--color-sidebar-mid);
        }
        .cal-day.header  { color: var(--color-sidebar-label); font-weight: 500; font-size: 0.5625rem; }
        .cal-day.weekend { color: var(--color-sidebar-label); }
        .cal-day.leave   { background: var(--color-accent-bg); color: var(--color-accent); }
        .cal-day.today   { background: var(--color-accent); color: #fff; font-weight: 600; }

        /* ── Avatar stack ── */
        .avatar-stack { display: flex; }
        .avatar {
            width: 26px; height: 26px;
            border-radius: 50%;
            border: 2px solid var(--color-navy);
            font-size: 0.625rem;
            font-weight: 500;
            display: flex; align-items: center; justify-content: center;
            margin-left: -6px;
        }
        .avatar:first-child { margin-left: 0; }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            body { padding: 0 !important; align-items: flex-start; background-color: var(--color-navy); }
            .card {
                flex-direction: column;
                border-radius: 0;
                min-height: 100svh;
                max-width: 100% !important;
                box-shadow: none;
                border: none;
            }
            .sidebar { width: 100% !important; border-radius: 0; padding: 28px 24px 20px !important; }
            .sidebar-stats { display: none !important; }
            .sidebar-tagline { display: none; }
            .sidebar-heading { font-size: 1.25rem !important; }
            .form-panel { border-radius: 0 !important; padding: 28px 24px 36px !important; flex: 1; }
            .form-inner { max-width: 100% !important; }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .sidebar { width: 260px !important; }
            .sidebar-stats .stat-box:last-child { display: none; }
        }

    </style>
</head>

<body class="flex items-center justify-center p-6 min-h-svh">

<div class="card flex w-full max-w-4xl overflow-hidden" style="min-height:560px;">

    <!-- ── SIDEBAR ─────────────────────────────────── -->
    <div class="sidebar w-80 shrink-0 flex flex-col justify-between p-8">

        <!-- Brand -->
        <div>
            <div class="flex items-center gap-2 mb-10">
                <div class="flex items-center justify-center size-8 rounded-[9px]" style="background:var(--color-accent);">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <rect x="2" y="3" width="6" height="12" rx="1.5" fill="white"/>
                        <rect x="10" y="7" width="6" height="8" rx="1.5" fill="rgba(255,255,255,0.5)"/>
                        <circle cx="13" cy="4" r="2.5" fill="rgba(255,255,255,0.8)"/>
                    </svg>
                </div>
                <span class="text-white font-semibold text-[17px] tracking-tight">LeaveSync</span>
            </div>

            <span class="accent-pill">Enterprise Leave Management</span>

            <h2 class="sidebar-heading text-white text-[26px] leading-snug mt-4 mb-2" style="font-family:var(--font-display);">
                Manage time off,<br/><em>effortlessly.</em>
            </h2>
            <p class="sidebar-tagline text-sm leading-relaxed" style="color:var(--color-sidebar-dim);">
                Track leaves, approvals, and workforce availability — all in one place.
            </p>
        </div>

        <!-- Stats -->
        <div class="sidebar-stats mt-8">
            <p class="text-[11px] font-medium uppercase tracking-[0.07em] mb-3" style="color:var(--color-sidebar-label);">This Month</p>

            <div class="stat-box mb-2.5">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs" style="color:var(--color-sidebar-mid);">Leave Requests</span>
                    <span class="text-[10px] font-medium px-2 py-0.5 rounded-full" style="background:var(--color-accent-tag);color:#7f9fff;">Active</span>
                </div>
                <div class="text-white text-[22px] font-semibold mb-1">24</div>
                <div class="text-[11px]" style="color:var(--color-sidebar-label);">↑ 3 pending approval</div>
            </div>

            <div class="stat-box mb-2.5">
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-xs" style="color:var(--color-sidebar-mid);">On Leave Today</span>
                    <div class="avatar-stack">
                        <div class="avatar" style="background:#4a6cf7;color:#fff;">AR</div>
                        <div class="avatar" style="background:#10b981;color:#fff;">SM</div>
                        <div class="avatar" style="background:#f59e0b;color:#fff;">KJ</div>
                        <div class="avatar" style="background:#3d4460;color:#8892aa;">+2</div>
                    </div>
                </div>
                <div class="text-white text-[22px] font-semibold">5</div>
            </div>

            <div class="stat-box">
                <div class="text-xs mb-2.5" style="color:var(--color-sidebar-mid);">April 2026</div>
                <div class="mini-calendar">
                    <div class="cal-day header">Mo</div><div class="cal-day header">Tu</div>
                    <div class="cal-day header">We</div><div class="cal-day header">Th</div>
                    <div class="cal-day header">Fr</div>
                    <div class="cal-day header weekend">Sa</div><div class="cal-day header weekend">Su</div>

                    <div class="cal-day"></div><div class="cal-day">1</div>
                    <div class="cal-day leave">2</div><div class="cal-day leave">3</div>
                    <div class="cal-day">4</div>
                    <div class="cal-day weekend">5</div><div class="cal-day weekend">6</div>

                    <div class="cal-day">7</div><div class="cal-day">8</div><div class="cal-day">9</div>
                    <div class="cal-day">10</div><div class="cal-day">11</div>
                    <div class="cal-day weekend">12</div><div class="cal-day weekend">13</div>

                    <div class="cal-day">14</div><div class="cal-day leave">15</div>
                    <div class="cal-day leave">16</div><div class="cal-day leave">17</div>
                    <div class="cal-day">18</div>
                    <div class="cal-day weekend">19</div><div class="cal-day weekend">20</div>

                    <div class="cal-day">21</div><div class="cal-day">22</div>
                    <div class="cal-day">23</div><div class="cal-day">24</div>
                    <div class="cal-day">25</div>
                    <div class="cal-day weekend">26</div><div class="cal-day weekend">27</div>

                    <div class="cal-day">28</div><div class="cal-day">29</div>
                    <div class="cal-day today">30</div>
                </div>
            </div>
        </div>

    </div>

    <!-- ── LOGIN FORM ──────────────────────────────── -->
    <div class="form-panel flex-1 flex flex-col justify-center bg-white px-10 py-10 rounded-r-[20px]">

        <div class="form-inner w-full max-w-[360px] mx-auto">

            <!-- Heading -->
            <div class="mb-8">
                <h1 class="text-[26px] font-semibold tracking-tight mb-1.5" style="color:var(--color-navy);">Welcome back</h1>
                <p class="text-sm" style="color:#888;">Sign in to your organization's portal</p>
            </div>

            <!-- SSO -->
            <div class="grid grid-cols-2 gap-2.5 mb-5">
                <button class="btn-sso">
                    <svg width="16" height="16" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Google SSO
                </button>
                <button class="btn-sso">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <rect width="11" height="11" x="1"  y="1"  fill="#F25022"/>
                        <rect width="11" height="11" x="13" y="1"  fill="#7FBA00"/>
                        <rect width="11" height="11" x="1"  y="13" fill="#00A4EF"/>
                        <rect width="11" height="11" x="13" y="13" fill="#FFB900"/>
                    </svg>
                    Microsoft
                </button>
            </div>

            <div class="divider mb-5">or sign in with email</div>

            <!-- Fields -->
            <div class="flex flex-col gap-3.5 mb-5">

                <div>
                    <label class="block text-[13px] font-medium mb-1.5" style="color:#444;">Work Email</label>
                    <input type="email" placeholder="you@company.com" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="text-[13px] font-medium" style="color:#444;">Password</label>
                        <a href="#" class="text-[12px] font-medium no-underline" style="color:var(--color-accent);">Forgot password?</a>
                    </div>
                    <input type="password" placeholder="••••••••••" />
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" class="size-[15px] cursor-pointer" style="accent-color:var(--color-accent);" />
                    <label for="remember" class="text-[13px] cursor-pointer" style="color:#666;">Keep me signed in for 30 days</label>
                </div>

            </div>

            <button class="btn-primary" onclick="this.textContent='Signing in…'">Sign In</button>

            <!-- Info note -->
            <div class="flex items-start gap-2 mt-5 p-3 rounded-[10px]" style="background:#f7f6f4;border:1px solid #ede9e3;">
                <svg class="shrink-0 mt-px" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span class="text-[12px] leading-relaxed" style="color:#888;">
            This is a single-organization portal. Contact your HR administrator to request access.
          </span>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-[11px] text-center" style="color:#bbb;">
                Protected by enterprise SSO &nbsp;·&nbsp;
                <a href="#" class="no-underline" style="color:#bbb;">Privacy</a> &nbsp;·&nbsp;
                <a href="#" class="no-underline" style="color:#bbb;">Terms</a>
            </p>

        </div>
    </div>

</div>

</body>
</html>
