<!DOCTYPE html>
<html lang="{{ $subscriber->locale }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $subscriber->locale === 'fr' ? 'Confirmez votre inscription' : 'Confirm your subscription' }}</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:ui-sans-serif,system-ui,-apple-system,sans-serif;">

@php
    $fr      = $subscriber->locale === 'fr';
    $lien    = route('locale.newsletter.confirmer', ['locale' => $subscriber->locale, 'token' => $subscriber->token]);
    $prenom  = $subscriber->prenom ? ", {$subscriber->prenom}" : '';
@endphp

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 16px;">
  <tr>
    <td align="center">
      <table width="560" cellpadding="0" cellspacing="0" style="max-width:560px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

        {{-- Header --}}
        <tr>
          <td style="background:#1A3C5E;padding:28px 36px;text-align:center;">
            <div style="display:inline-block;background:#C9A96E;color:#1A3C5E;font-weight:900;font-size:18px;width:40px;height:40px;line-height:40px;text-align:center;border-radius:10px;">N</div>
            <div style="color:#ffffff;font-weight:700;font-size:16px;margin-top:8px;">NIMA Real Estate</div>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="padding:36px 36px 28px;text-align:center;">
            <h1 style="margin:0 0 12px;font-size:24px;font-weight:700;color:#1A3C5E;">
              {{ $fr ? 'Une dernière étape !' : 'One last step!' }}
            </h1>
            <p style="margin:0 0 8px;font-size:15px;color:#374151;line-height:1.6;">
              {{ $fr ? "Bonjour{$prenom}," : "Hello{$prenom}," }}
            </p>
            <p style="margin:0 0 28px;font-size:15px;color:#374151;line-height:1.6;">
              @if($fr)
                Cliquez sur le bouton ci-dessous pour confirmer votre inscription à la newsletter NIMA Real Estate et recevoir nos actualités, nouveaux projets et opportunités d'investissement.
              @else
                Click the button below to confirm your NIMA Real Estate newsletter subscription and start receiving our news, new projects and investment opportunities.
              @endif
            </p>

            {{-- CTA --}}
            <a href="{{ $lien }}"
               style="display:inline-block;background:#C9A96E;color:#1A3C5E;font-weight:700;font-size:15px;padding:14px 32px;border-radius:10px;text-decoration:none;letter-spacing:0.01em;">
              {{ $fr ? 'Confirmer mon inscription' : 'Confirm my subscription' }}
            </a>

            <p style="margin:24px 0 0;font-size:12px;color:#9ca3af;">
              @if($fr)Si vous n'avez pas rempli ce formulaire, ignorez cet e-mail.@else If you did not fill in this form, simply ignore this email.@endif
            </p>
          </td>
        </tr>

        {{-- Lien textuel (fallback) --}}
        <tr>
          <td style="padding:0 36px 20px;text-align:center;">
            <p style="margin:0;font-size:11px;color:#9ca3af;">
              {{ $fr ? 'Ou copiez ce lien dans votre navigateur :' : 'Or copy this link in your browser:' }}<br>
              <a href="{{ $lien }}" style="color:#1A3C5E;word-break:break-all;font-size:11px;">{{ $lien }}</a>
            </p>
          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="padding:20px 36px;border-top:1px solid #e5e7eb;text-align:center;">
            <p style="margin:0;font-size:11px;color:#9ca3af;">
              &copy; {{ date('Y') }} NIMA Real Estate — Yaoundé, Cameroun<br>
              @if($fr)Vous recevez cet e-mail suite à une inscription sur nimarealestate.com.@else You received this email after signing up at nimarealestate.com.@endif
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
