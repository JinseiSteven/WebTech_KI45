import random
import string

def get_random_string(length):
    # choose from all lowercase letter
    letters = string.ascii_lowercase
    result_str = ''.join(random.choice(letters) for i in range(length))
    return result_str


amount = 10

# (`userName`, `userStudentID`, `userPwd`)

for i in range(amount):
    print(f"('{get_random_string(5)}', {random.randint(10000000, 99999999)}, '$2y$10$v8.u.e7Q/89GNZZWqxqDaeE0sXG/hqWA7KYo7svH83hqsm6Al8/Ly'),")
    