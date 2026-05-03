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
   - **Job Title** (right sidebar) → Job title or role (e.g. *Lead Developer*)
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

```
[team_members number="4"]
[team_members image_position="bottom" show_all_button="false"]
[team_members number="3" image_position="top" show_all_button="true"]
```