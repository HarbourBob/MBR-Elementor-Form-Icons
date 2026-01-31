=== MBR Elementor Form Icons ===

Plugin URI: https://littlewebshack.com
Author: Robert Palmer
Author URI: https://madebyrobert.co.uk
Requires at least: 5.8
Tested up to: 6.9
Stable tag: 1.2.1
Requires PHP: 7.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Add Font Awesome icons to your Elementor Pro form fields with flexible positioning options.

## Description

MBR Elementor Form Icons extends Elementor Pro's Form Widget by adding the ability to include Font Awesome icons in your form fields. Choose from multiple positioning options to create beautiful, intuitive forms that guide users with visual cues.

**Features:**

- Add Font Awesome icons to any form field
- Multiple icon positioning options:
  - Above the field
  - Inside the placeholder text
  - Inside field (left)
  - Inside field (right)
- Customize icon color and size
- Support for Font Awesome Solid, Regular, and Brands icon sets
- Works with all standard Elementor form field types
- Fully responsive
- RTL language support
- No configuration needed - works right out of the box

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- Elementor (free version)
- Elementor Pro
- Modern browser with CSS3 support

## Installation

1. Upload the `mbr-elementor-form-icons` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit any page with Elementor
4. Add or edit a Form Widget
5. Configure icons in the form field settings

## Usage

### Adding Icons to Form Fields

1. In Elementor, edit a page with a Form Widget
2. Click on the Form Widget to edit it
3. Go to Content > Form Fields
4. Click on any field to expand its settings
5. Look for the "Enable Icon" toggle (under the field options)
6. Enable the icon and configure:
   - **Icon Library**: Choose between Solid, Regular, or Brands
   - **Icon Class**: Enter the icon name (e.g., `user`, `envelope`, `phone`)
   - **Icon Position**: Choose where to display the icon
   - **Icon Color**: Set the icon color
   - **Icon Size**: Adjust the icon size

### Icon Positioning Options

**Above Field**
- Icon appears above the input field
- Great for adding visual context to form sections

**In Placeholder**
- Icon is embedded in the placeholder text
- Uses emoji equivalents for better cross-browser support
- Best for simple, recognizable icons

## Styling and Customization

The plugin includes default styling that works with most themes. If you need to customize:

### CSS Customization

Add custom CSS in Elementor or your theme's custom CSS:

```css
/* Change icon color globally */
.mbr-efi-icon {
    color: #your-color;
}

/* Adjust icon above spacing */
.mbr-efi-icon-above {
    margin-bottom: 15px;
}

/* Customize inside-left icon position */
.mbr-efi-field-wrapper.mbr-efi-icon-inside-left .mbr-efi-icon {
    left: 20px;
}
```

### Per-Widget Customization

You can also use Elementor's Custom CSS feature on the Form Widget:

```css
selector .mbr-efi-icon {
    color: #ff0000;
    font-size: 20px;
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## Changelog

### 1.2.1
- Initial release
- Support for Font Awesome icons in form fields
- Four icon positioning options
- Color and size customization
- RTL support
- Responsive design

## Credits

- Developed by **Robert Palmer**
- Website: https://littlewebshack.com
- Icons by Font Awesome (https://fontawesome.com)

## License

This plugin is licensed under GPL v2 or later.

```
Copyright (C) 2026 Made by Robert

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## Support

For bug reports, feature requests, or contributions, please visit:
https://littlewebshack.com

---

Made with ❤️ by Robert in Cleethorpes, England
