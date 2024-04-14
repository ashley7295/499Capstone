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
from selenium import webdriver
from selenium.webdriver.common.by import By

def submit_form_with_answers():
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

        assert "Dashboard" in driver.title

        current_forms_link = WebDriverWait(driver, 10).until(
            EC.element_to_be_clickable((By.LINK_TEXT, "Current"))
        )
        

        # Click on the Current Forms link
        current_forms_link.click()

        # #ADD SOEMTHING HERE TO CLICK ON CURRENTFORM PAGE
        # # Find the form element
        # form = driver.find_element(By.CLASS_NAME, "cssform2")

        # # Select a form by interacting with the radio buttons
        # radio_buttons = form.find_elements(By.NAME, "form_id")
        # # Assuming you want to select the first radio button, you can modify this to select a specific one if needed
        # radio_buttons[0].click()

        # # Submit the form
        # submit_button = form.find_element(By.XPATH, "//input[@type='submit']")
        # submit_button.click()

        # # Wait for the next page to load (assuming submitAnswers.php is the target page)
        # # You can add explicit waits here if needed
        # # e.g., WebDriverWait(driver, 10).until(EC.url_to_be("TARGET_URL"))

        # # Find the form element containing the questions and answer options
        # form_answers = driver.find_element(By.CLASS_NAME, "cssform2")

        # # Select answers for each question
        # # For demonstration purposes, let's assume we select the first option for each question
        # answer_options = form_answers.find_elements(By.XPATH, "//input[@type='radio']")
        # for option in answer_options:
        #     option.click()

        # # Submit the form
        # submit_answers_button = form_answers.find_element(By.XPATH, "//input[@type='submit']")
        # submit_answers_button.click()

        # Wait for the next page to load (assuming the target page after submitting answers)
        # You can add explicit waits here if needed
        # e.g., WebDriverWait(driver, 10).until(EC.url_to_be("TARGET_URL"))

        # Verify that the form submission was successful (optional)
        # You can add verification steps here, depending on what you expect to see on the next page

    finally:
        # Close the browser
        driver.quit()





# Run test cases
#test_successful_login()
#test_invalid_credentials()
#test_reset_password_page()
submit_form_with_answers()