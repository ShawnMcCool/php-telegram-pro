#!/bin/zsh

# This script serves as a hyper-simple user-interface for selecting
# and executing api tests. It is clumsy but it works. I would have 
# spent more time on it if I was convinced of its value.

# You can use arrow keys to navigate, ENTER key to select
# INS/DEL/t/T/U keys can be used to tag multiple tests.

# This file stores the previous query
PREVIOUS_OPTION_CACHE_FILE=.previous_method_test_option
# Default previous option (is blank)
PREVIOUS=""
# Test path
TEST_PATH=./tests/Api/Methods/

# Overload the default previous option from cache file
if [[ ( -a ${PREVIOUS_OPTION_CACHE_FILE} ) || ( ! "" = "$(cat .previous_method_test_option)" ) ]]; then
    PREVIOUS="\"Previous: $(cat .previous_method_test_option)\"\n"
fi

# Generate a list of options with an "All" item included at the top.
OPTIONS="${PREVIOUS}All\n$(ls -1 tests/Api/Methods)"

# Display the menu and store the selection
SELECTION=$(echo ${OPTIONS} | smenu -r -c -d -m"Telegram Method Tests" -n20 -T\ )

# Clear "PREVIOUS" string
SELECTION=$(echo ${SELECTION} | sed -e 's/Previous: //g' | sed -e 's/ /\n/g')

ESCAPED_PATH=$(echo $TEST_PATH | sed -e 's/\//\\\//g')

# Expand 'All' option into full folder
if [[ "$SELECTION" == "All" ]]; then SELECTION=""; fi

TEST_FILE_PATHS=$(echo ${SELECTION} | sed -e 's/^/'"$ESCAPED_PATH"'/g')

# Store "previous" option
echo $SELECTION | tr '[:space:]' ' '  > .previous_method_test_option

# Execute Tests
CMD=$(echo "./bin/phpunit ${TEST_FILE_PATHS}" | tr '[:space:]' ' ')

eval $CMD