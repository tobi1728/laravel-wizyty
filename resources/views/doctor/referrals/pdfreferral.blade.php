<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Skierowanie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #000;
        }

        .card {
            width: 600px;
            margin: auto;
            background: #fff;
            border: 1px solid #ccc;
            padding: 30px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 20px;
            text-align: center;
        }

        .section {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }

        .line {
            margin: 6px 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Skierowanie</h1>

        <div class="section">
            <div class="line">
                <span class="label">Pacjent:</span>
                {{ $referral->appointment->patient?->user->firstName ?? 'Brak' }}
                {{ $referral->appointment->patient?->user->lastName ?? '' }}
            </div>

            <div class="line">
                <span class="label">Data wizyty:</span>
                {{ $referral->appointment->appointment_date ?? 'Brak' }}
            </div>

            <div class="line">
                <span class="label">Specjalizacja:</span>
                {{ $referral->target_specialization }}
            </div>

            <div class="line">
                <span class="label">Uwagi:</span>
                {{ $referral->reason ?? '–' }}
            </div>

            <div class="line">
                <span class="label">Kod skierowania:</span>
                {{ $referral->refferal_code }}
            </div>

            <div class="line">
                <span class="label">Data wystawienia:</span>
                {{ $referral->issue_date }}
            </div>
        </div>
    </div>
</body>
</html>
