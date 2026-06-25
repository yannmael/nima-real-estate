<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouveau lead NIMA</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:ui-sans-serif,system-ui,-apple-system,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:32px 16px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        {{-- Header --}}
        <tr>
          <td style="background:#1A3C5E;padding:28px 32px;">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <span style="display:inline-block;background:#C9A96E;color:#1A3C5E;font-weight:900;font-size:16px;width:36px;height:36px;line-height:36px;text-align:center;border-radius:8px;vertical-align:middle;">N</span>
                  <span style="color:#ffffff;font-weight:700;font-size:18px;vertical-align:middle;margin-left:10px;">NIMA Real Estate</span>
                </td>
                <td align="right">
                  @if($lead->score >= 60)
                    <span style="background:#C9A96E;color:#1A3C5E;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;letter-spacing:0.05em;">QUALIFIÉ · {{ $lead->score }}/100</span>
                  @else
                    <span style="background:rgba(255,255,255,0.15);color:#ffffff;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;">SCORE {{ $lead->score }}/100</span>
                  @endif
                </td>
              </tr>
            </table>
          </td>
        </tr>

        {{-- Title --}}
        <tr>
          <td style="padding:28px 32px 0;">
            <h1 style="margin:0;font-size:22px;font-weight:700;color:#1A3C5E;">Nouveau lead reçu</h1>
            <p style="margin:6px 0 0;color:#6b7280;font-size:14px;">{{ $lead->created_at->format('d/m/Y à H:i') }}</p>
          </td>
        </tr>

        {{-- Contact --}}
        <tr>
          <td style="padding:20px 32px 0;">
            <h2 style="margin:0 0 12px;font-size:13px;font-weight:700;color:#1A3C5E;text-transform:uppercase;letter-spacing:0.08em;border-bottom:2px solid #C9A96E;padding-bottom:6px;">Coordonnées</h2>
            <table width="100%" cellpadding="4" cellspacing="0" style="font-size:14px;color:#374151;">
              <tr>
                <td style="color:#6b7280;width:140px;padding-bottom:6px;">Nom</td>
                <td style="font-weight:600;">{{ $lead->nom_complet }}</td>
              </tr>
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">E-mail</td>
                <td><a href="mailto:{{ $lead->email }}" style="color:#1A3C5E;">{{ $lead->email }}</a></td>
              </tr>
              @if($lead->telephone)
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Téléphone</td>
                <td><a href="tel:{{ $lead->telephone }}" style="color:#1A3C5E;">{{ $lead->telephone }}</a></td>
              </tr>
              @endif
            </table>
          </td>
        </tr>

        {{-- Projet --}}
        <tr>
          <td style="padding:20px 32px 0;">
            <h2 style="margin:0 0 12px;font-size:13px;font-weight:700;color:#1A3C5E;text-transform:uppercase;letter-spacing:0.08em;border-bottom:2px solid #C9A96E;padding-bottom:6px;">Projet</h2>
            <table width="100%" cellpadding="4" cellspacing="0" style="font-size:14px;color:#374151;">
              <tr>
                <td style="color:#6b7280;width:140px;padding-bottom:6px;">Type</td>
                <td style="font-weight:600;text-transform:capitalize;">{{ $lead->type_projet }}</td>
              </tr>
              @if($lead->surface)
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Surface</td>
                <td>{{ number_format($lead->surface, 0, ',', ' ') }} m²</td>
              </tr>
              @endif
              @if($lead->budget)
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Budget</td>
                <td>{{ $lead->budget }}</td>
              </tr>
              @endif
              @if($lead->lieu)
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Lieu</td>
                <td>{{ $lead->lieu }}</td>
              </tr>
              @endif
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Source</td>
                <td>{{ $lead->source }}</td>
              </tr>
              <tr>
                <td style="color:#6b7280;padding-bottom:6px;">Langue</td>
                <td>{{ strtoupper($lead->locale) }}</td>
              </tr>
            </table>
          </td>
        </tr>

        {{-- Message --}}
        @if($lead->message)
        <tr>
          <td style="padding:20px 32px 0;">
            <h2 style="margin:0 0 12px;font-size:13px;font-weight:700;color:#1A3C5E;text-transform:uppercase;letter-spacing:0.08em;border-bottom:2px solid #C9A96E;padding-bottom:6px;">Message</h2>
            <p style="margin:0;font-size:14px;color:#374151;line-height:1.6;background:#f9fafb;border-left:3px solid #C9A96E;padding:12px 16px;border-radius:0 6px 6px 0;">
              {{ $lead->message }}
            </p>
          </td>
        </tr>
        @endif

        {{-- Footer --}}
        <tr>
          <td style="padding:28px 32px;border-top:1px solid #e5e7eb;margin-top:28px;">
            <p style="margin:0;font-size:12px;color:#9ca3af;text-align:center;">
              Cet e-mail a été généré automatiquement par le site <strong>nimarealestate.com</strong>.<br>
              Ne pas répondre directement à cet e-mail — répondez au prospect via son adresse.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
