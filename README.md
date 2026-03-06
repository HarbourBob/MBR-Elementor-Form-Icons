# MBR Elementor Form Icons

[![Version](https://img.shields.io/badge/version-1.4.0-blue.svg)](https://littlewebshack.com)
[![WordPress](https://img.shields.io/badge/WordPress-5.8%2B-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org)
[![Elementor Pro](https://img.shields.io/badge/Elementor_Pro-3.0%2B-92003b.svg?logo=elementor&logoColor=white)](https://elementor.com)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777bb4.svg?logo=php&logoColor=white)](https://php.net)
[![Font Awesome](https://img.shields.io/badge/Font_Awesome-6.5.1-528dd7.svg?logo=font-awesome&logoColor=white)](https://fontawesome.com)
[![License](https://img.shields.io/badge/License-GPL_v2%2B-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Made by Robert](https://img.shields.io/badge/Made_by-Robert-orange.svg)](https://littlewebshack.com)

> Add beautiful Font Awesome icons to your Elementor Pro form fields — beautifully and effortlessly.

---

## 📸 Preview

```
Name    [ 👤  Name...          ]
Email   [ ✉️  Email...         ]
Message [ ✏️  Your message...  ]
        [       Send           ]
```

---

## ✨ Features

- 🎨 **Native Elementor Icon Library** — Choose from thousands of Font Awesome icons using Elementor's built-in visual icon picker
- 📍 **Two Positioning Options** — Above the field label, or inside the field as an overlay icon
- 🎨 **Full Customisation** — Control icon colour and size per field
- 📐 **Smart Textarea Handling** — Icons in textarea fields pin to the top rather than centering
- 🙈 **Hide on Input** — Placeholder icons gracefully disappear when users start typing
- ⚡ **Lightweight** — Clean data-attribute approach with no inline scripts
- 📱 **Responsive** — Works perfectly on all screen sizes
- 🔧 **Per-Field Control** — Enable icons on individual fields independently

---

## 📋 Requirements

| Requirement | Version |
|---|---|
| WordPress | 5.8 or higher |
| PHP | 7.4 or higher |
| Elementor Pro | 3.0 or higher |

> ⚠️ **Elementor Pro is required.** The Form widget is a Pro-only feature.

---

## 🚀 Installation

1. Download the latest release ZIP
2. In your WordPress admin go to **Plugins → Add New → Upload Plugin**
3. Upload the ZIP file and click **Install Now**
4. Click **Activate Plugin**

Or manually:
```
wp-content/plugins/
└── mbr-elementor-form-icons/
```

---

## 📖 How to Use

1. Edit any page in Elementor
2. Add or select an existing **Form** widget
3. Click on any **form field** in the panel
4. Scroll down to find the **Icon** section
5. Toggle **Enable Icon** to **Yes**
6. Click **Choose Icon** to open Elementor's icon library
7. Select your icon, then set:
   - **Icon Position** — Above Field or In Placeholder
   - **Icon Color** — Hex colour picker
   - **Icon Size** — 10px to 50px slider
8. Click **Update** or **Preview** to see your icons

> ℹ️ Icon changes are visible in **Preview mode** or on the **Frontend**. The Elementor editor live preview does not reflect icon changes in real time.

---

## 🎯 Icon Positions

### Above Field
The icon appears to the left of the field label, providing a visual cue above the input.

```
[👤] Name
┌─────────────────────────┐
│ Your name...            │
└─────────────────────────┘
```

### In Placeholder
The icon is overlaid inside the field, sitting alongside the placeholder text. It disappears when the user begins typing.

```
┌─────────────────────────┐
│ 👤  Your name...        │
└─────────────────────────┘
```

---

## 🗂️ File Structure

```
mbr-elementor-form-icons/
├── assets/
│   ├── css/
│   │   ├── form-icons.css       # Frontend styles
│   │   └── editor.css           # Editor panel styles
│   └── js/
│       ├── form-icons.js        # Frontend icon rendering
│       └── editor.js            # Editor panel behaviour
├── includes/
│   ├── class-form-field-controls.php   # Adds controls to Elementor panel
│   └── class-form-field-renderer.php   # Renders icon data attributes
├── mbr-elementor-form-icons.php        # Main plugin file
├── uninstall.php
├── readme.md
└── readme.txt
```

---

## 🔧 Troubleshooting

**Icons not showing on the frontend?**
- Confirm Elementor Pro is active
- Clear any caching plugins
- Ensure **Enable Icon** is toggled on for the field
- Click **Update** in the editor to save settings

**Icon color not applying?**
- Use the hex colour picker — global Elementor colours are not supported in this version

**Icons look misaligned?**
- Try adjusting the icon size slider
- Check for conflicting theme or plugin CSS targeting `.elementor-field-label` or `.elementor-field-group`

---

## 📜 Changelog

### 1.0.0
- Initial release
- Elementor native icon library integration
- Above field and placeholder positioning
- Per-field colour and size controls
- Smart textarea top-positioning
- Data attribute rendering architecture

---

## 📄 License

**GPL v2 or later** — Free to use, modify, and distribute.  
See [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for details.

---

## 👨‍💻 Author

**Made by Robert**  
WordPress Developer — Cleethorpes, England 🇬🇧

- 🌐 [littlewebshack.com](https://littlewebshack.com)
- 🔌 More free plugins available on the website

---

## 🌟 Other Free Plugins by Made by Robert

| Plugin | Description |
|---|---|
| MBR Cookie Consent | GDPR/CCPA compliant cookie consent manager |
| MBR Live Radio Player | Embedded live radio streaming player |
| Advanced Asset Manager | WordPress media and asset management |
| MBR WP Performance | Comprehensive WordPress performance optimiser |

---

*Made with ❤️ for the WordPress community*
