# Google reCAPTCHA Setup Guide

## Step 1: Get reCAPTCHA Keys

1. Go to [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Click on the **+** button to register a new site
3. Fill in the form:
   - **Label**: Your Portfolio Website
   - **reCAPTCHA type**: Select **reCAPTCHA v2** → **"I'm not a robot" Checkbox**
   - **Domains**: Add your domain (e.g., `localhost`, `yourdomain.com`)
   - Accept the terms and click **Submit**

4. You'll receive two keys:
   - **Site Key** (Public key - used in frontend)
   - **Secret Key** (Private key - used in backend)

## Step 2: Add Keys to .env File

Open your `.env` file and add these lines:

```env
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
```

Replace `your_site_key_here` and `your_secret_key_here` with the actual keys from Google.

## Step 3: Clear Config Cache

Run this command to clear the config cache:

```bash
php artisan config:clear
```

## Step 4: Test the Contact Form

1. Visit your website's contact section
2. Fill out the form
3. Complete the reCAPTCHA challenge
4. Submit the form
5. Check if the email is sent successfully

## Troubleshooting

### reCAPTCHA not showing?
- Make sure the site key is correct in `.env`
- Check browser console for JavaScript errors
- Verify the domain is added in reCAPTCHA admin console

### Verification failing?
- Ensure the secret key is correct in `.env`
- Check if the server can connect to Google's servers
- Run `php artisan config:clear` after updating `.env`

### For Development (localhost)
- Add `localhost` or `127.0.0.1` to the domains list in reCAPTCHA admin console
- reCAPTCHA works on localhost for testing

## Security Notes

- Never commit your `.env` file to version control
- Keep your secret key private
- Use different keys for development and production environments
