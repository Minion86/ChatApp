# Security remediation — 2026-10-16

Updated BotMan and its compatible dependencies. The lockfile resolves against a PHP 7.3 platform to avoid imposing a PHP major-version upgrade. PHP 7.3 itself is end-of-life; deploy with a supported PHP runtime. Validated dependency installation and BotMan factory/HTTP request construction using PHP 8.3. No external chat messages were sent.

Composer audit reports no vulnerable dependencies in the updated lockfile. Removed tracked Composer vendor dependencies so a clean deployment must run `composer install --no-dev --prefer-dist` in / before serving the application. The dependency scan does not certify application code or bundled third-party assets.
