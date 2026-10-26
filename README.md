# Folio

A modern WordPress **block theme** and a companion **custom blocks plugin**, built to practise and show full-site-editing development: a design system in `theme.json`, reusable patterns, and custom Gutenberg blocks written with React.

Built by **Aksha Patel**.


---

## What's inside

This repository has two parts that work together:

| Folder | What it is |
|---|---|
| `themes/folio/` | The block theme: `theme.json` design system, templates, template parts and patterns |
| `plugins/folio-blocks/` | The plugin that holds custom blocks (React in the editor, saved HTML on the front end) |

The repository root is WordPress's `wp-content` folder, with a `.gitignore` that tracks only these two folders.

Blocks live in a plugin, not the theme, so they keep working if the site changes theme later.

## Features

**Theme (`themes/folio`)**
- Design system in `theme.json`: colour palette, gradient, fluid typography, spacing scale and shadow presets
- Header and footer template parts, sticky header, responsive navigation with a mobile overlay
- Page and blog index templates
- Patterns in a custom "Folio" category: Hero, Services cards, Pricing, Call to action
- Accessible details: reduced-motion support, semantic `header`, `main` and `footer` elements, readable contrast

**Plugin (`plugins/folio-blocks`)**
- **Pricing Plan** block: editable plan name, price and description; a sidebar for the feature list, highlight toggle, badge text and button link
- **Pricing Table** parent block: holds Pricing Plan blocks (InnerBlocks) in a responsive grid, with a starting template and a columns control

Planned: a dynamic Project Grid block with a custom post type, and the Interactivity API for filtering.

## Requirements

- WordPress 6.5 or newer
- PHP 8.0 or newer
- Node.js 20 or newer (only needed to build the plugin)

## Getting started

1. Set up a local WordPress site (I use Local).
2. Clone this repository into the site's `wp-content` folder, for example into an empty folder, then copy `themes/folio` and `plugins/folio-blocks` into the matching places. If you cloned straight into `wp-content`, they are already in place.
3. Activate the **Folio** theme under **Appearance → Themes**.
4. Build the plugin:
   ```bash
   cd wp-content/plugins/folio-blocks
   npm install
   npm run build
   ```
5. Activate **Folio Blocks** under **Plugins**.
6. Create a page, add patterns from **+ → Patterns → Folio**, and the **Pricing Table** block from the inserter.

For development, run `npm start` in the plugin folder. It rebuilds automatically whenever you save a file.

## Project structure

```
themes/folio/
├── functions.php        # loads styles, registers the pattern category
├── style.css            # theme header + custom CSS
├── theme.json           # the design system
├── parts/               # header.html, footer.html
├── patterns/            # hero.php, services.php, pricing.php, cta.php, logo.php
├── assets/images/       # logo SVG files and site icon
└── templates/           # index.html, page.html

plugins/folio-blocks/
├── folio-blocks.php     # registers the blocks found in /build
├── package.json
└── src/
    ├── folio-blocks/    # Pricing Plan block
    │   ├── block.json   # data model (attributes) and settings
    │   ├── edit.js      # what you see in the editor
    │   ├── save.js      # the HTML saved to the database
    │   ├── index.js     # registers the block
    │   ├── style.scss   # front end + editor styles
    │   └── editor.scss  # editor-only styles
    └── pricing-table/   # Pricing Table parent block (same file set)
```

---

## Developer notes (my cheat sheet)

### The three jobs of a block

Every block does the same three things. If I can remember these, I can look up the details.

| File | Job | Question it answers |
|---|---|---|
| `block.json` | Data | What does this block store, and what is it called? |
| `edit.js` | Editor | What does the person see and edit in the editor? |
| `save.js` | Output | What HTML gets saved to the database? |

### Static vs dynamic blocks

- **Static block** (my Pricing Plan): `save.js` outputs finished HTML and WordPress stores it in the page content. It still displays if the plugin is deactivated, but can no longer be edited properly.
- **Dynamic block**: `save` returns nothing, and PHP (`render.php`) builds the output on every page load. Use this for live data such as posts, products or API results.

If I change `save.js` after a block has been saved on a page, the old copies show as "invalid". During development, delete and re-insert the block. In production, add a `deprecated` entry so old content migrates.

### Patterns vs blocks

| | Pattern | Block |
|---|---|---|
| What it is | A saved layout of blocks | A reusable component with its own data |
| Edited later | Each copy is separate | Each instance has its own settings |
| Good for | Page sections, quick layouts | Structured content, logic, dynamic data |

Use the simplest tool that works: core blocks, then patterns, then a custom block.

### `theme.json` vs `style.css`

- `theme.json` holds design values: colours, font sizes, spacing, default block styles. Presets become CSS variables such as `var(--wp--preset--color--accent)`.
- `style.css` holds what `theme.json` cannot express: sticky positioning, pseudo-elements, hover effects, animations.

### Rules I learnt the hard way

- Block themes use **`.html`** for templates and parts. PHP files only for `functions.php` and patterns.
- `parts/`, `patterns/` and `templates/` sit at the **top level** of the theme.
- `functions.php` must have exactly that name, and start with `<?php`.
- Block themes do **not** load `style.css` automatically: enqueue it in `functions.php`.
- Do not reuse a palette colour for a different job. Add a new colour slug instead, because everything referencing the old slug changes with it.
- Template parts and styles saved in the Site Editor are stored in the database and override the theme files. Use **Clear customizations** when a file change does not show up.
- Use `color: inherit` on links inside a coloured container so the container's colour is set in one place.
- In block markup, the HTML must match the comment's attributes. When editing by hand, change both together.

### Useful commands

```bash
npm start        # watch and rebuild while developing
npm run build    # production build
npm run format   # format the code
npm run lint:js  # lint JavaScript
```

### Debug checklist

1. Is `WP_DEBUG` on? (`wp-config.php`)
2. Is `npm start` still running, and did it say `compiled successfully`?
3. Did I hard-refresh the editor (Ctrl+Shift+R)?
4. Is the file in the right folder, with the exact right name?
5. Right-click → **Inspect** to see which CSS rule is winning, and where it comes from.

## Roadmap

- [x] Theme skeleton, design system, header and footer
- [x] Hero, Services, Pricing and Call-to-action patterns
- [x] Pricing Plan custom block
- [x] Pricing Table parent block with InnerBlocks
- [x] Logo (inline SVG pattern that follows the text colour)
- [ ] Project custom post type and dynamic Project Grid block
- [ ] Interactivity API: filter projects without a page reload
- [ ] Testimonials and FAQ patterns, a dark style variation
- [ ] Accessibility and performance pass, screenshots

## Licence

Add a licence before publishing, for example MIT or GPL-2.0-or-later.
