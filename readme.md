# Welcome Theme

A starter theme for business websites built with Advanced Web Tools (AWT). Welcome Theme gives you Home, About, and Contact pages, shared navigation, and a responsive layout to adapt for your company or client project.

Use it as a foundation for a company profile, service business, consultancy, or agency website. Replace the sample copy, apply your branding, and extend the pages as your business needs grow.

## What's included

- Home, About, and Contact pages at `/`, `/about`, and `/contact`.
- Shared header and footer with active page navigation.
- Configurable site title, tagline, accent color, contact details, and footer text.
- Optional left and right sidebars controlled through ThemeEngine.
- Editable URPC JSON content for every page and shared section.
- Local CSS with no required JavaScript, external fonts, or images.

The Contact page provides an email link. Add a separate integration if your project needs a contact form, booking, payments, or other business workflows.

## Requirements

| Component | Minimum version |
| --- | --- |
| AWT | 27.0.0 |
| ThemeEngine | 1.0.4 |
| URPC | 1.0.0 |

## Get started

Install and enable the required packages in your AWT site, then install the WelcomeTheme package. Open `/dashboard/customization`, select **WelcomeTheme**, and choose **Activate theme**.

Set your business name, tagline, contact email, and accent color in the customization dashboard. Replace the sample page content with your own services, company story, and contact information before publishing.

See the [installation and customization guide](WelcomeTheme/README.md) for package commands, editable files, and instructions for adding pages.

## Project layout

| Path | Purpose |
| --- | --- |
| `WelcomeTheme/` | Installable theme package |
| `WelcomeTheme/documents/` | Home, About, and Contact content in URPC JSON |
| `WelcomeTheme/sections/` | Shared header, footer, and optional sidebars in URPC JSON |
| `WelcomeTheme/assets/theme.css` | Theme styles |
| `WelcomeTheme/theme.php` | Pages, routes, section sources, and theme settings |
| `WelcomeTheme/manifest.json` | Package identity, version, and dependencies |
| `build/` | Local packaging and development deployment tools |

## Build a package

To package a customized version, install PHP with the ZIP extension and create `build/dev_env.json`:

```json
{
  "release_folder": "releases",
  "build_save_format": "<name>-<version>"
}
```

Run from the repository root:

```bash
bash build.sh --no-install
```

On Windows, run `build.bat --no-install`. This creates `releases/WelcomeTheme-1.0.0.zip` without deploying it. Update the version in `WelcomeTheme/manifest.json` when preparing a new release.

Use a full build for delivery to a client or a fresh installation. The optional `--fast` mode creates an incremental development archive that can omit unchanged files.

## Development deployment

For deployment to a development AWT instance, add the connection settings to `build/dev_env.json`:

```json
{
  "release_folder": "releases",
  "build_save_format": "<name>-<version>",
  "address": "http://localhost:3000",
  "remote_install_path": "/dev/install",
  "devSecret": "replace-with-your-development-secret"
}
```

Enable `DEBUG` and `REMOTE_INSTALL_FOR_DEVS` on that development instance and match its `dev_secret` to `devSecret`. PHP cURL is required for deployment. Run `bash build.sh --install` to build and deploy, or `bash build.sh` to be prompted after building. Keep the development installation endpoint disabled on production sites.

## License

The package manifest declares the MIT license.
