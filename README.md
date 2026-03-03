# MBR Elementor Form Icons

[![WordPress Plugin Version](https://img.shields.io/badge/version-1.2.9-blue?style=flat-square&logo=wordpress)](https://github.com/harbourbob/mbr-elementor-form-icons)
[![WordPress Tested](https://img.shields.io/badge/WordPress-6.9%20tested-4AB866?style=flat-square&logo=wordpress)](https://wordpress.org)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/license-GPL%20v2%2B-green?style=flat-square)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Requires Elementor Pro](https://img.shields.io/badge/requires-Elementor%20Pro-E2215B?style=flat-square)](https://elementor.com/pro)
[![GitHub Downloads](https://img.shields.io/github/downloads/harbourbob/mbr-elementor-form-icons/total?style=flat-square&color=brightgreen&logo=github)](https://github.com/harbourbob/mbr-elementor-form-icons/releases)

---

![MBR Elementor Form Icons](mrb-forms.webp)

---

**Add Font Awesome icons to your Elementor Pro form fields — beautifully, simply, for free.**

Choose between two display modes: drop an icon *inside* the field as a placeholder, or place it *above* alongside the label. Control icon, colour, and size on a per-field basis, with full support for Elementor global colours and live editor preview updates.

No premium tier. No upsells. No vendor lock-in. Just a clean, well-built tool that does exactly what it says.

---

## ✨ Features

- **Two icon modes** — placeholder (inside the input) or above (next to the label)
- **Per-field controls** — individual icon, colour, and size for every field
- **Global colour support** — works seamlessly with Elementor's global colour system
- **Live editor preview** — icons update in real time as you edit in Elementor
- **Zero bloat** — Font Awesome is loaded from Elementor's own bundled copy; no extra HTTP requests if it's already on the page
- **Textarea aware** — icons pin to the top of multi-line fields rather than awkwardly centring
- **Clean injection** — pure JavaScript DOM injection; no PHP template overrides

---

## 📋 Requirements

| Requirement | Version |
|---|---|
| WordPress | 5.8 or later |
| PHP | 7.4 or later |
| Elementor (free) | Latest recommended |
| Elementor Pro | Required (Form widget) |

---

## 🚀 Installation

1. Download the latest release zip from the [Releases](https://github.com/harbourbob/mbr-elementor-form-icons/releases) page
2. In your WordPress dashboard go to **Plugins → Add New → Upload Plugin**
3. Upload the zip and click **Install Now**, then **Activate**
4. Open any page with an Elementor Pro form in the editor
5. Click a form field → open the **MBR Icons** tab → enable the toggle and configure

---

## 🛠️ How It Works

Elementor Pro's form widget renders its fields client-side via JavaScript templates — standard PHP `render_content` filters get discarded milliseconds after the page loads. MBR Elementor Form Icons works around this by injecting icons purely via JavaScript after Elementor's render cycle completes.

On the **frontend**, field data (icon, colour, size, position) is baked server-side into a localised script variable (`mbrEfiData`) and injected once Elementor signals the widget is ready via `frontend/element_ready`.

In the **editor preview**, the plugin polls the live DOM and reads icon settings directly from Elementor's Backbone model — so changes in the settings panel are reflected in the preview without needing to save.

---

## 📁 File Structure

```
mbr-elementor-form-icons/
├── mbr-elementor-form-icons.php   # Main plugin file
├── assets/
│   └── js/
│       └── form-icons.js          # Frontend + editor injection logic
├── readme.txt                     # WordPress.org readme
└── README.md                      # This file
```

---

## 📝 Changelog

### 1.2.8
- Fixed global colours not applying on the frontend due to missing field type in localised data

### 1.2.7
- Fixed global colour CSS variables (`var(--e-global-color-*)`) being stripped by hex-only sanitization

### 1.2.6
- Fixed placeholder icon vertical alignment on single-line inputs — now centres within the input itself, not the field group
- Fixed textarea placeholder icons now pin to the top of the field

### 1.2.5
- Fixed jittery placeholder text shift during editor re-renders caused by orphaned `padding-left` on inputs

### 1.2.4
- Fixed editor preview injection when `elementor-field-group-{id}` classes are absent from the editor template — falls back to field type matching

### 1.2.3
- Fixed script execution context — injection now correctly targets the preview iframe
- Replaced unreliable event-based approach with polling for editor re-render detection

### 1.2.2
- Fixed icons disappearing after Elementor editor re-renders
- Fixed Font Awesome loading from Elementor's bundled copy with CDN fallback
- Fixed stale DOM references with live `document.querySelector` calls

### 1.2.1
- Initial release

---

## 🤝 Contributing

Found a bug or have a feature idea? [Open an issue](https://github.com/harbourbob/mbr-elementor-form-icons/issues) or submit a pull request. All contributions welcome.

---

## 👨‍💻 Author

Built by **Robert Palmer** at [Little Web Shack](https://littlewebshack.com) — bespoke WordPress development based in the UK.

If this plugin saves you time or money, a coffee is always appreciated! ☕

[![Buy Me a Coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-buymeacoffee.com-FFDD00?style=for-the-badge&logo=buy-me-a-coffee)](https://buymeacoffee.com/robertpalmer/)

---

## 📄 License

Released under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).
