<?php
if (!isset($INTERGITY_CHECK)) {
    header("Location: /");
    exit();
}
# use story.json to get the story and its options
function getStory($title)
{
    $story = file_get_contents('story.json');
    $story = json_decode($story, true);
    return $story["story"][$title];
}

# actions are written like ["set-race: human", "goto: beginning III"]
function parseAction($actions) {
    $parsedActions = [];
    foreach ($actions as $action) {
        $action = explode(': ', $action);
        $parsedActions[$action[0]] = $action[1];
    }
    return $parsedActions;
}

function getAllValidPages()
{
    $story = file_get_contents('story.json');
    $story = json_decode($story, true);
    return array_keys($story['story']);
}

# template parser. {{name}} will be replaced with $_SESSION['user_data']['kv']['name']. it shoudl work if there are multiple {{name}} in the same string
function parseText($text)
{
    $matches = [];
    preg_match_all('/{{(.*?)}}/', $text, $matches);
    foreach ($matches[1] as $match) {
        $text = str_replace('{{' . $match . '}}', $_SESSION['user_data']['kv'][$match], $text);
    }
    // if the value that we just made is just an integer, we can return it as an integer
    if (is_numeric($text)) {
        return (int) $text;
    }
    // if it contains only numbers and +,-,*,/,. we can do a math operation
    else if (preg_match('/^[0-9\+\-\*\/\.]+$/', $text)) {
        return eval('return ' . $text . ';');
    } else {
        return $text;
    }
}

# execute the action (set-race would set $_SESSION['user_data']['kv']['race'] = 'human')
# and goto would set $_SESSION['user_data']['story']['currentPage'] = 'beginning III' and reload the page
function executeAction($actions)
{
    foreach ($actions as $key => $value) {
        switch ($key) {
            case 'end':
                $_SESSION['user_data']['story']['currentPage'] = null;
                header("Location: /");
                exit();

            case 'goto':
                # validate that the page exists
                if (!in_array($value, getAllValidPages())) {
                    return;
                }
                # if there already is a currentPage, add it to $_SESSION['user_data']['story']['pagesDone'] list
                if (isset($_SESSION['user_data']['story']['currentPage'])) {
                    $_SESSION['user_data']['story']['pagesDone'][] = $_SESSION['user_data']['story']['currentPage'];
                }

                $_SESSION['user_data']['story']['currentPage'] = $value;
                header("Location: /");
                exit();

            case str_sw($key, 'set-'):
                $key = str_replace('set-', '', $key);
                $_SESSION['user_data']['kv'][$key] = parseText($value);
                break;


            default:
                break;
        }
    }
}


function str_sw($haystack, $needle)
{
    return strpos($haystack, $needle) === 0;
}

function str_ew($haystack, $needle)
{
    return substr($haystack, -strlen($needle)) === $needle;
}

function runAction($action)
{
    $actions = parseAction($action);
    executeAction($actions);
}

# get all valid options for the current page using the $_SESSION['user_data']['kv'] array and the requirements array
# requirements are written like
# "requirements": {
#        "race": ["orc", "human"]
#    }
# setting reqirements is optional
function validOptions($options)
{
    $validOptions = [];
    foreach ($options as $optionName => $option) {
        if (isset($option['requirements'])) {
            $requirements = $option['requirements'];
            $valid = true;
            foreach ($requirements as $key => $value) {
                if (!in_array($_SESSION['user_data']['kv'][$key], $value)) {
                    $valid = false;
                }
            }
            if ($valid) {
                $validOptions[$optionName] = $option;
            }
        } else {
            $validOptions[$optionName] = $option;
        }
    }
    return $validOptions;
}

function runActionFromPage($currentPage, $option)
{
    if (!isset($currentPage)) {
        return;
    }
    $page = getStory($currentPage);
    if (!in_array($option, array_keys($page['options']))) {
        return;
    }
    if (!in_array($option, array_keys(validOptions($page['options'])))) {
        return;
    }
    $actions = parseAction($page['options'][$option]['action']);
    executeAction($actions);
}

function getKV($key)
{
    if (!isset($_SESSION['user_data']['kv'][$key])) {
        return null;
    }
    return $_SESSION['user_data']['kv'][$key];
}

function setKV($key, $value)
{
    $_SESSION['user_data']['kv'][$key] = $value;
}

function getStoryData($key)
{
    if (!isset($_SESSION['user_data']['story'][$key])) {
        return null;
    }
    return $_SESSION['user_data']['story'][$key];
}

function setStoryData($key, $value)
{
    $_SESSION['user_data']['story'][$key] = $value;
}
