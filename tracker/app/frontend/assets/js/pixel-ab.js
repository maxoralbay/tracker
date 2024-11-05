// pixel.js
(function () {
    // Check if cookie exists
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // Set cookie with 30 days expiration
    function setCookie(name, value) {
        const date = new Date();
        date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
    }

    // Get browser info
    function getBrowserInfo() {
        const ua = navigator.userAgent;
        let browser = "Unknown";

        if (ua.includes("Firefox")) browser = "Firefox";
        else if (ua.includes("Chrome")) browser = "Chrome";
        else if (ua.includes("Safari")) browser = "Safari";
        else if (ua.includes("Edge")) browser = "Edge";
        else if (ua.includes("MSIE") || ua.includes("Trident/")) browser = "IE";

        return browser;
    }

    // Get device type
    function getDeviceType() {
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
            return "tablet";
        }
        if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated/i.test(ua)) {
            return "mobile";
        }
        return "desktop";
    }

    // Get platform/OS
    function getPlatform() {
        const platform = navigator.platform;
        if (platform.includes("Win")) return "Windows";
        if (platform.includes("Mac")) return "MacOS";
        if (platform.includes("Linux")) return "Linux";
        if (/iPhone|iPad|iPod/.test(platform)) return "iOS";
        if (platform.includes("Android")) return "Android";
        return "Unknown";
    }

    // Main tracking function
    async function trackVisit() {
        // Check if already tracked
        if (getCookie('visitor_tracked')) {
            return;
        }

        const visitData = {
            domain: window.location.hostname,
            page: window.location.pathname,
            timestamp: new Date().toISOString(),
            userAgent: navigator.userAgent,
            browser: getBrowserInfo(),
            device: getDeviceType(),
            platform: getPlatform()
        };

        try {
            const response = await fetch('/track.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(visitData)
            });

            if (response.ok) {
                setCookie('visitor_tracked', '1');
            }
        } catch (error) {
            console.error('Tracking failed:', error);
        }
    }

    // Contact form handler
    function setupContactForm() {
        const form = document.createElement('form');
        form.innerHTML = `
            <div style="max-width: 400px; margin: 20px auto; padding: 20px; border: 1px solid #ccc;">
                <h3>Contact Us</h3>
                <div style="margin-bottom: 10px;">
                    <input type="text" name="name" placeholder="Your Name" required 
                           style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="tel" name="phone" placeholder="Phone Number" 
                           style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="email" name="email" placeholder="Email" 
                           style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <button type="submit" 
                        style="background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                    Submit
                </button>
            </div>
        `;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const contactData = {
                name: formData.get('name'),
                phone: formData.get('phone'),
                email: formData.get('email')
            };

            try {
                const response = await fetch('/contact.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(contactData)
                });

                if (response.ok) {
                    alert('Thank you for your submission!');
                    form.reset();
                }
            } catch (error) {
                console.error('Contact submission failed:', error);
            }
        });

        document.body.appendChild(form);
    }

    // Initialize tracking and form
    window.addEventListener('load', () => {
        trackVisit();
        setupContactForm();
    });
})();