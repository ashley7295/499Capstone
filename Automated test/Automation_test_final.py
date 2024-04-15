from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException

def test_successful_login():
    # Initialize the WebDriver
    driver = webdriver.Chrome()
    try:
        # Open the login page
        driver.get("http://localhost/499Capstone/html/login.html")

        # Find the username and password fields and enter valid credentials
        username_field = driver.find_element(By.ID, "username")
        password_field = driver.find_element(By.ID, "password")
        username_field.send_keys("user1")
        password_field.send_keys("password1")

        # Click the login button
        login_button = driver.find_element(By.XPATH, "//input[@type='submit']")
        login_button.click()

        # Wait for the dashboard page to load
        WebDriverWait(driver, 10).until(EC.title_contains("Dashboard"))

        # Verify that the dashboard page is loaded successfully
        assert "Dashboard" in driver.title

        # If the assertion passes, print a success message
        print("Test case: Successful login - PASSED")

    finally:
        # Close the browser window
        driver.quit()


def test_invalid_credentials():
    # Initialize the WebDriver
    driver = webdriver.Chrome()
    try:
        # Open the login page
        driver.get("http://localhost/499Capstone/html/login.html")

        # Find the username and password fields and enter invalid credentials
        username_field = driver.find_element(By.ID, "username")
        password_field = driver.find_element(By.ID, "password")
        username_field.send_keys("user1")
        password_field.send_keys("password5")

        # Click the login button
        login_button = driver.find_element(By.XPATH, "//input[@type='submit']")
        login_button.click()

        # Wait for the alert to be present
        try:
            WebDriverWait(driver, 10).until(EC.alert_is_present())
            alert = driver.switch_to.alert
            assert alert.text == "Login failed. Please check your username and password."
            print("Test case: Invalid credentials - PASSED")
            alert.accept()
        except TimeoutException:
            print("Test case: Invalid credentials - FAILED")

    finally:
        # Close the browser window
        driver.quit()


def test_reset_password_page():
    # Initialize the WebDriver
    driver = webdriver.Chrome()
    try:
        # Open the login page
        driver.get("http://localhost/499Capstone/html/login.html")

        # Find the "Forgot password" link and click it
        forgot_password_link = driver.find_element(By.XPATH, "//a[contains(text(), 'Forgot password')]")
        forgot_password_link.click()

        # Wait for the reset password page to load
        WebDriverWait(driver, 10).until(EC.title_contains("Password Change"))

        # Verify that the reset password page is loaded successfully
        assert "Password Change" in driver.title

        # Find the username, old password, new password, and confirm password fields
        username_field = driver.find_element(By.ID, "username")
        old_password_field = driver.find_element(By.ID, "oldPassword")
        new_password_field = driver.find_element(By.ID, "newPassword")
        confirm_password_field = driver.find_element(By.ID, "confirmPassword")
        submit_button = driver.find_element(By.ID, "submitbutton")

        # Enter the necessary information
        username_field.send_keys("user1")  # Replace "username" with actual username
        old_password_field.send_keys("password1")  # Replace "old_password" with actual old password
        new_password_field.send_keys("Password1")  # Replace "new_password" with actual new password
        confirm_password_field.send_keys("Password1")  # Confirm new password

        # Click the submit button to reset the password
        submit_button.click()

        #Change code below to expect dashboard instead
        # Wait for the success message or confirmation page to appear
        WebDriverWait(driver, 10).until(EC.title_contains("Login"))  # Adjust the condition based on the confirmation page title or success message

        # Verify that the password reset was successful
        assert "Login" in driver.title  # Adjust the condition based on the confirmation page title or success message

        # If the assertion passes, print a success message
        print("Test case: Reset Password Page - PASSED")

    finally:
        # Close the browser window
        driver.quit()


# Run test cases
#test_successful_login()
test_invalid_credentials()
#test_reset_password_page()