=== MBR Elementor Form Icons ===
Contributors: robertpalmer
Tags: elementor, form, icons, font awesome, elementor pro
Requires at least: 5.8
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.2.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add Font Awesome icons to Elementor Pro form fields — display them as inline placeholders or above field labels.

== Description ==

MBR Elementor Form Icons lets you enhance your Elementor Pro forms with Font Awesome icons on a per-field basis. Choose to display each icon as a placeholder inside the input field, or alongside the field label above it.

Designed as a lightweight, free alternative to premium solutions — no upsells, no vendor lock-in.

**Features**

* Add Font Awesome icons to any Elementor Pro form field
* Two display modes: placeholder (inside the field) or above (next to the label)
* Per-field icon, colour, and size controls
* Full support for Elementor global colours
* Live preview updates in the Elementor editor
* Automatically loads Font Awesome from Elementor's bundled copy — no extra HTTP requests
* Works with single-line inputs and textarea fields
* No premium version, no upsells

**Requirements**

* Elementor (free) — latest version recommended
* Elementor Pro — required for the Form widget

== Installation ==

1. Upload the `mbr-elementor-form-icons` folder to the `/wp-content/plugins/` directory, or install via the WordPress plugin screen.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Open any page containing an Elementor Pro form in the Elementor editor.
4. Click a form field to select it, then open the **MBR Icons** tab in the field settings.
5. Enable the icon toggle, choose your icon, position, colour and size.

== Frequently Asked Questions ==

= Does this work with the free version of Elementor? =

The Form widget is an Elementor Pro feature, so Elementor Pro is required. The plugin will not load if Elementor Pro is not active.

= Which icons are supported? =

Any Font Awesome icon available in Elementor's icon picker. The plugin loads Font Awesome from Elementor's own bundled copy so no additional stylesheet is added if Font Awesome is already present on the page.

= Will icons show in the Elementor editor preview? =

Yes. Icons are injected into the live editor preview and update when you change field settings.

= Does it support Elementor global colours? =

Yes. Both hex colours and Elementor global colour variables are fully supported.

= Does it work with all field types? =

Icons can be added to text, email, textarea, and most standard field types.

== Changelog ==

= 1.2.8 =
* Fixed: Global colours not applying correctly on the frontend due to missing field type data in localised script output

= 1.2.7 =
* Fixed: Global colours (CSS custom properties) stripped by hex-only sanitization — now accepts both hex and `var(--e-global-color-*)` values

= 1.2.6 =
* Fixed: Placeholder icon vertical alignment on single-line inputs now centres precisely within the input rather than the field group
* Fixed: Textarea placeholder icon now positions at the top of the field rather than vertically centred

= 1.2.5 =
* Fixed: Jittery placeholder text shift during editor re-renders caused by orphaned padding-left on inputs

= 1.2.4 =
* Fixed: Editor preview icon injection falling back to field type selector when `elementor-field-group-{id}` classes are absent in the editor preview template

= 1.2.3 =
* Fixed: Script execution context detection — injection now correctly targets the preview iframe
* Improved: Polling-based injection replaces unreliable event-based approach for editor re-renders

= 1.2.2 =
* Fixed: Icons disappearing after Elementor editor re-renders by switching to pure JavaScript injection
* Fixed: Font Awesome loaded from Elementor's bundled copy with CDN fallback
* Fixed: Stale DOM references replaced with live `document.querySelector` calls

= 1.2.1 =
* Initial public release

== Upgrade Notice ==

= 1.2.8 =
Fixes global colours not applying on the frontend. Update recommended.