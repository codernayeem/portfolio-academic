    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Md. Nayeem</h3>
                    <p>App Developer & CSE Student</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#projects">Projects</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <div class="social-links">
                        <a href="https://github.com/codernayeem" target="_blank">GitHub</a>
                        <a href="https://linkedin.com/in/codernayeem" target="_blank">LinkedIn</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?>  Md. Nayeem. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript Files -->
    <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
    <?php if (isset($additionalJS)) echo $additionalJS; ?>
</body>
</html>
