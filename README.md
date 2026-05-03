# Dolbol — Team Members Plugin

A lightweight WordPress plugin that manages and displays team members.

**Version:** 0.1.0<br>
**Author:** [Niloy Mahmud Apu](https://niloy.me)<br>
**Requires WordPress:** 6.0+<br>
**Requires PHP:** 7.4+<br>
**License:** GPL-2.0-or-later<br>

---

## Installation

1. Copy the `dolbol` folder into `wp-content/plugins/`.
2. Activate the plugin from **Plugins → Installed Plugins** in the WordPress admin.
3. Go to **Settings → Permalinks** and click **Save Changes** (required to register the custom post type URLs).

---

## Creating Team Members

1. In the WordPress admin, go to **Team Members → Add Team Member**.
2. Fill in the fields:
   - **Full Name** → Member's full name
   - **Bio** (editor area) → Member's bio
   - **Job Title** (below the editor) → Job title or role (e.g. *Lead Developer*)
   - **Profile Picture** (right sidebar) → Member's profile picture
3. Publish the post.

---

## Shortcode Usage

Place the shortcode anywhere on a page or post:

```
[team_members]
```

### Parameters

| Parameter | Type | Default | Description |
|---|---|---|---|
| `number` | int | `10` | Number of team members to display |
| `image_position` | string | `top` | Profile picture position — `top` or `bottom` |
| `show_all_button` | boolean | `true` | Show a "See All" link to the archive page |

### Examples

```text
[team_members number="4"]
[team_members image_position="bottom" show_all_button="false"]
[team_members number="3" image_position="top" show_all_button="true"]
```

---

## Design Selection

We use a simple and flexible layout approach that changes depending on the `image_position` parameter (`top` or `bottom`). The template logic (`templates/team-members-list.php`) toggles rendering the profile picture either before or after the member's text details. By managing everything in a centralized template file, it maintains clean code and avoids duplication while easily letting administrators alter the presentation via shortcode attributes. This ensures you can seamlessly switch the focal point of the team member block to either the name or their picture depending on the context.

---

## Bonus Features

- **Object-Oriented Architecture**: The complete backend foundation is modular and built on strict Object-Oriented principles. Responsibilities are compartmentalized into distinct utility classes (e.g., `DLBL_Post_Type`, `DLBL_Meta_Box`, `DLBL_Shortcode`), preventing pollution of the global namespace and making future expansions far simpler.
- **Archive Pagination**: Implemented complete pagination handling on the archive page, allowing smooth navigation when there are numerous team members. The default items per page on the archive is natively controlled via your WordPress **Settings → Reading** ("Blog pages show at most").