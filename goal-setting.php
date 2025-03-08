<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
    <meta name="keywords" content="goal setting, goal tracking, productivity, personal development, Elevate">
    <meta name="author" content="Anotida Muchinhairi">
    <link rel="shortcut icon" href="./img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="vendor/bootstrap-5.0.2-dist/css/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="vendor/aos/aos.css" />
    <link rel="stylesheet" href="vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="./css/main.css" />
    <title>Elevate: Goal Setting</title>
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <div class="container mt-5 pt-5">
        <div class="bg-light shadow-lg mx-auto my-4 border-bottom border-5 border-primary rounded">
            <div class="section-title p-3 text-center bg-primary rounded-top">
                <h3 class="text-center text-light">Create a New Goal</h3>
                <p class="lead text-light">Setting clear goals helps you focus on what's important. Please provide the following information to create your goal.</p>
            </div>

            <form id="goal-form" method="POST" onsubmit="handleFormSubmit(event)">
                <div class="m-5">
                    <!-- Goal Information Section -->
                    <div class="pb-5">
                        <h4 class="text-info">Goal Information</h4>
                        <div class="row">
                        <div class="mb-3">
                            <label for="goal-name" class="form-label">Goal Name:</label>
                            <input type="text" name="goal-name" class="form-control" id="goal-name" required />
                        </div>

                        <div class="mb-3">
                            <label for="goal-category" class="form-label">Goal Category:</label>
                            <select name="goal-category" class="form-select" id="goal-category" required>
                                <option value="">Select</option>
                                <option value="Work and Career">Work and Career</option>
                                <option value="Health and Wellness">Health and Wellness</option>
                                <option value="Love and Relationship">Love and Relationship</option>
                                <option value="Money and Finance">Money and Finance</option>
                                <option value="Family and Friends">Family and Friends</option>
                                <option value="Spiritually and Faith">Spiritually and Faith</option>
                                <option value="Recreation and Lifestyle">Recreation and Lifestyle</option>
                                <option value="Personal Growth">Personal Growth</option>
                                <option value="Other Goals">Other Goals</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="goal-description" class="form-label">Goal Description:</label>
                            <textarea name="goal-description" class="form-control" id="goal-description" rows="4" required></textarea>
                        </div>

                        <!-- Task Section -->
                        <div class="mb-3">
                            <label for="tasks" class="form-label">Add tasks to complete your goal:</label>
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="new-task" placeholder="Add new task" />
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary w-100" id="add-task-btn">Add Task</button>
                                </div>
                            </div>
                            <ul id="tasks-list" class="list-unstyled mt-3">
                                <!-- tasks will be added here -->
                            </ul>
                            <input type="hidden" name="tasks" id="tasks" />
                        </div>
                    </div>

                    <!-- Deadline and Target Section -->
                    <div class="pb-5">
                        <h4 class="text-info">Deadline and Target</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="target-date" class="form-label">Target Date:</label>
                                <input type="date" name="target-date" class="form-control" id="target-date" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="starting-date" class="form-label">Starting Date:</label>
                                <input type="date" name="starting-date" class="form-control" id="starting-date" required />
                            </div>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="with-target-checkbox" id="with-target-checkbox" data-bs-toggle="collapse" data-bs-target="#target-options" aria-expanded="false" />
                            <label class="form-check-label" for="with-target-checkbox">Include specific target?</label>
                        </div>

                        <div class="collapse" id="target-options">
                            <p class="text-info fs-5">How do you want to track your progress?</p>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="border rounded p-2 bg-light">
                                        <input type="radio" name="goal-completion-type" value="Completing tasks" id="completing-tasks" class="form-check-input" />
                                        <label for="completing-tasks" class="form-check-label">By Completing Tasks</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded p-2 bg-light">
                                        <input type="radio" name="goal-completion-type" value="Reaching specific target" id="specific-target" class="form-check-input" data-bs-toggle="collapse" data-bs-target="#specific-target-options" />
                                        <label for="specific-target" class="form-check-label">By Reaching Specific Target</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Target for Reaching Specific Target -->
                            <div class="collapse" id="specific-target-options">
                                <section class="border rounded p-3 bg-light">
                                    <div class="mb-3">
                                        <label for="numeric-target" class="form-label">Numeric Target:</label>
                                        <input type="number" name="numeric-target" max="100" class="form-control" id="numeric-target" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="starting-value" class="form-label">Starting Value:</label>
                                        <input type="number" name="starting-value" min="0" class="form-control" id="starting-value" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="unit" class="form-label">Unit:</label>
                                        <select class="form-select" name="unit" id="unit">
                                            <option value="">Select</option>
                                            <option value="kg">kg</option>
                                            <option value="lbs">lbs</option>
                                            <option value="%">%</option>
                                            <option value="$">$</option>
                                        </select>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row offset-md-6 pb-5">
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-danger w-100" type="reset">Cancel</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-success w-100" type="submit" name="submit">Save Goal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="vendor/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/aos/aos.js"></script>
    <script src="./scripts/goal-setting.js"></script>
    <script>
        function handleFormSubmit(event) {
            event.preventDefault();
            const form = document.getElementById('goal-form');
            const formData = new FormData(form);

            fetch("config/goal-setting-config.php", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Handle the response data
                console.log(data);
                if (data.status === 'success') {
                    alert('Goal saved successfully!');
                    form.reset(); // Clear the form
                } else {
                    alert('An error occurred: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the goal: ' + error.message);
            });
        }
    </script>
    <?php include "footer.php" ?>
</body>

</html>
