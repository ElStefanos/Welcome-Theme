# Welcome Theme

Welcome Theme is a starter theme for business websites on Advanced Web Tools (AWT). It includes a responsive Home, About, and Contact website with editable content and configurable branding, ready to adapt for your company or client.

The supplied English copy is sample content. Replace it with your business information before publishing.

## Requirements

- AWT 27.0.0 or later.
- ThemeEngine 1.0.4 or later.
- URPC 1.0.0 or later.

## Installation

Install and enable ThemeEngine and URPC first. From the root of your AWT installation, install the theme archive:

```bash
php awt pm install /path/to/WelcomeTheme-1.0.0.zip
php awt pm list
php awt pm enable THEME_PACKAGE_ID
```

Replace `THEME_PACKAGE_ID` with the WelcomeTheme ID shown by the package list. Then open `/dashboard/customization`, select **WelcomeTheme**, and choose **Activate theme**. Enabling the package and activating it as the site's theme are separate steps.

The theme provides these public pages:

| Page | Address | Suggested business content |
| --- | --- | --- |
| Home | `/` | Your main offer, key services, and a clear next step |
| About | `/about` | Your company story, experience, and approach |
| Contact | `/contact` | Contact introduction and business email |

## Apply your branding

Use the customization dashboard to set:

| Setting | Use |
| --- | --- |
| Site title | Your business or brand name |
| Tagline | A short description beneath the name |
| Contact email | The address visitors can email |
| Contact introduction | The opening text on the Contact page |
| Footer text | Your preferred footer message |
| Accent color | The color used for links, buttons, and highlights |

Replace the default `hello@example.com` address with your business email. The Contact page uses a validated `mailto:` link that opens the visitor's email application. An invalid or empty address displays a setup message instead of a link. Message delivery through a website form requires an additional integration.

Header, footer, and optional left and right sidebars are managed through ThemeEngine's layout controls. Sidebars are disabled by default; enable them when you need supplementary links or information. The main page content remains present.

## Edit page content

All page content and shared sections use URPC JSON. Edit the following files in your theme source, then package and install the updated theme:

| File | Content |
| --- | --- |
| `documents/home.json` | Home introduction, calls to action, and highlight cards |
| `documents/about.json` | About introduction and company story |
| `documents/contact.json` | Contact layout, headings, and supporting copy |
| `sections/header.json` | Branding and main navigation |
| `sections/footer.json` | Footer text and home link |
| `sections/side_l.json` | Optional navigation sidebar |
| `sections/side_r.json` | Optional supporting content |
| `assets/theme.css` | Typography, spacing, colors, and responsive styles |

Each JSON file contains a `blocks` array. Blocks define an element, attributes, text content, and child blocks. For example:

```json
{
  "blocks": [
    {
      "descriptor": {
        "name": "h1",
        "props": {},
        "renderer": ""
      },
      "attributes": {},
      "content": "Your business starts here.",
      "children": []
    }
  ]
}
```

Use `content` for text and `children` for nested elements. URPC escapes text and attributes when rendering. Keep the existing CSS classes where you want to retain the starter styling.

Some blocks receive their content from dashboard settings. Their `descriptor.props` values control that behavior:

| Property | Behavior |
| --- | --- |
| `"setting": "site_title"` | Uses the named theme setting as the block's text |
| `"active_page": "home"` | Marks the navigation link as current on the matching page |
| `"contact_email": true` | Uses the validated contact email as link text and destination |
| `"when": "valid_email"` | Includes the child block when the contact email is valid |
| `"when": "invalid_email"` | Includes the child block when the contact email is invalid or empty |

The same `setting` property supports `tagline`, `contact_intro`, and `footer_text`. Edit those values in the dashboard, or remove the binding if a block should use fixed JSON text.

## Extend the starter

To add a page, create its JSON content under `documents/`, add a page controller extending `WelcomeTheme\pages\WelcomePage`, and register the page and route in `theme.php`. Add navigation links to `sections/header.json` and, if used, `sections/side_l.json`.

`theme.php` defines the theme's pages, routes, section sources, stylesheets, and settings. `pages/WelcomePage.php` applies settings, active navigation, email validation, and the accent color. Page content and shared section blocks remain in JSON.

ThemeEngine registers the public page routes for the active theme. `main.php` registers the stylesheet route at `/welcome-theme/theme.css`.

## Prepare for publication

1. Replace sample copy with your business name, services, company story, and contact details.
2. Check navigation and email links on all three pages.
3. Review desktop and mobile layouts, including any enabled sidebars.
4. Add any additional pages or integrations required by your project.
5. Build a full package and verify it in your target AWT environment before publishing.

## Developer verification

From this package directory, run the JSON checks against your local dependencies:

```bash
THEME_ENGINE_ROOT=/path/to/ThemeEngine AWT_ROOT=/path/to/AWT URPC_ROOT=/path/to/URPC php tests/json.php
```

`THEME_ENGINE_ROOT` and `URPC_ROOT` point to the package directories containing their `api/` and `service/` folders. `AWT_ROOT` points to the framework directory containing `awt_src/`.

These checks cover JSON sources, active navigation, setting escaping, email validation, and repeated rendering. The separate `tests/run.php` integration suite requires the ThemeEngine test environment, including `tests/bootstrap.php`.

## License

The package manifest declares the MIT license.
