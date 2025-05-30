<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>eRecepta</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 30px;
    }

    .card {
      width: 360px;
      margin: auto;
      background: #fff;
      border: 1px solid #ccc;
      padding: 20px;
      box-shadow: 0 0 5px #bbb;
    }

    h1 {
      font-size: 24px;
      text-align: left;
      margin: 0 0 15px;
    }

    .section {
      margin-bottom: 15px;
    }

    .section .label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
    }

    .info-line {
      font-size: 13px;
    }

    .box {
      border-top: 1px dashed #aaa;
      margin: 20px 0;
    }

    .small {
      font-size: 11px;
      color: #444;
    }

    .code-large {
      font-size: 18px;
      text-align: center;
      font-weight: bold;
      letter-spacing: 2px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>erecepta</h1>

    <div class="code-large">
      Kod dostepu: {{ $prescription->prescription_code ?? '----' }}
    </div>

    <div class="info-line center">Wystawiono: {{ \Carbon\Carbon::parse($prescription->issue_date)->format('d.m.Y') }}</div>

    <div class="box"></div>

    <div class="section">
      <div class="label">Pacjent:</div>
      @php $user = $prescription->appointment->patient->user ?? null; @endphp
      {{ $user ? $user->firstName . ' ' . $user->lastName : '-' }}
    </div>

    <div class="section">
      <div class="label">Wystawca:</div>
      @php $doc = $prescription->appointment->doctor?->user; @endphp
      {{ $doc?->firstName }} {{ $doc?->lastName }}<br>
      PWZ: {{ $prescription->appointment->doctor?->license_number }}<br>
    </div>

    <div class="section">
      <div class="label">Termin kontroli:</div>
      {{ $prescription->control_date ? \Carbon\Carbon::parse($prescription->control_date)->format('d.m.Y H:i') : '-' }}
    </div>

    <div class="box"></div>

    <div class="section">
      <div class="label">Lek:</div>
      {{ $prescription->medicine->medicine_name }} ({{ $prescription->medicine->active_substance }})<br>
      Dawka: {{ $prescription->notes ?? '1 x 1' }}
    </div>

    <div class="section">
      <div class="label">Data realizacji:</div>
      do {{ \Carbon\Carbon::parse($prescription->valid_until)->format('d.m.Y') }}
    </div>

    <div class="box"></div>

    <div class="small">
      Oswiadczam, ze nie realizowalem/am wczesniej recepty z pozycji.<br>
      Jestem swiadomy/a odpowiedzialnosci karnej za zlozenie falszywego oswiadczenia.
    </div>
  </div>
</body>
</html>
