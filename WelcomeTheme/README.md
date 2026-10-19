# Welcome Theme 1.0.0

Jednostavna početna tema za AWT 27, URPC 1.0.0 i ThemeEngine 1.0.4.

Rute: `/` (Home), `/about` (About), `/contact` (Contact). Navigacija je na vrhu, sa oznakom aktivne stranice. Zajednički header i footer, responsive layout i dve opcione bočne sekcije. Contact prikazuje email link; ne šalje poruke preko servera i nema lažnu submit formu.

## Instalacija

Iz korena AWT instalacije prvo ažuriraj prethodni ThemeEngine:

```bash
php awt pm update /putanja/ThemeEngine-1.0.4.zip
php awt pm install /putanja/WelcomeTheme-1.0.0.zip
php awt pm list
php awt pm enable ID_WELCOME_THEME_PAKETA
```

Zameni poslednji ID stvarnim ID-jem iz liste. Otvori `/dashboard/customization`, izaberi WelcomeTheme i klikni Activate theme. Tema je paket tipa 2 i normalno je inicijalno disabled. Aktiviranje paketa i izbor teme za sajt su zasebni koraci.

Podesavanja: naziv sajta, tagline, kontakt email, uvodni kontakt tekst, footer tekst i akcentna boja. Kontakt email je inicijalno `hello@example.com`: zameni ga svojim. Sekcije header/footer/side_l/side_r kontroliše ThemeEngine; content ostaje prisutan. Bočne sekcije su inicijalno isključene prema podrazumevanim engine podešavanjima. Preseti i cache koriste postojeći engine.

## Struktura

`theme.php` deklariše tri stranice i javne rute. `pages/*Page.php` nasleđuju zajednički WelcomePage, koji nasleđuje engine ThemePage/URPC i primenjuje akcentnu boju pre dodele ID-jeva. `documents/home.json`, `documents/about.json` i `documents/contact.json` sadrže sadržaj svih stranica u URPC JSON formatu. Zajedničke sekcije su isključivo JSON: `sections/header.json`, `sections/footer.json`, `sections/side_l.json` i `sections/side_r.json`. Nema PHP section providera. `WelcomePage` povezuje JSON blokove sa podešavanjima i aktivnom rutom; URPC escapuje tekst i atribute.

`main.php` tokom AWT runtime-a registruje samo CSS rutu `/welcome-theme/theme.css`; javne stranice registruje ThemeEngine za aktivnu temu. U `main.php` ne dupliraj javne rute. CSS URL se servira preko AWT Response::file(). Tema ne zahteva JavaScript, externe fontove ili slike.

Ovo su URPC stranice, ne Blade view-ovi. Ako kasnije dodaš obične AWT view-ove, njihova ekstenzija je `.awt.php`. Postojeći engine eventi `theme_engine.theme.loaded` i `theme_engine.page.ready` rade i za ovu temu.

Sadržaj je na engleskom i namerno služi kao početni welcome tekst. Uredi JSON dokumente i sekcije, a konfiguraciju u dashboardu. U `descriptor.props`, `setting` postavlja tekst bloka iz podešavanja, `active_page` označava aktivni navigacioni link, `contact_email: true` postavlja validirani email i `mailto:` link, a `when: "valid_email"` / `"invalid_email"` bira kontakt blok prema validnosti email adrese. PHP ne kreira blokove sadržaja.

Testirana integracija sa stvarnim AWT runtime/linker/router klasama i URPC-om; produkciona MySQL instalacija nije izvršena. Browser vizuelni pregled nije izvršen.

## Provera

```bash
THEME_ENGINE_ROOT=/putanja/ThemeEngine AWT_ROOT=/putanja/AWT URPC_ROOT=/putanja/URPC php tests/run.php
```

Integracioni test zahteva `tests/bootstrap.php` iz ThemeEngine test okruženja. Nezavisna provera JSON izvora i povezivanja sa podešavanjima koristi stvarni URPC loader i renderer:

```bash
THEME_ENGINE_ROOT=/putanja/ThemeEngine AWT_ROOT=/putanja/AWT URPC_ROOT=/putanja/URPC php tests/json.php
```

Provera pokriva sve tri stranice, sve JSON sekcije, aktivnu navigaciju, escapovanje podešavanja, validne/nevalidne/prazne email adrese i ponovljeno renderovanje.
