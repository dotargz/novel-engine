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

# actions are written like "set-race, human; goto, beginning III"
function parseAction($action)
{
    $action = explode(';', $action);
    $actions = [];
    foreach ($action as $a) {
        $a = explode(',', $a);
        $actions[trim($a[0])] = trim($a[1]);
    }
    return $actions;
}


function getAllValidPages()
{
    $story = file_get_contents('story.json');
    $story = json_decode($story, true);
    return array_keys($story['story']);
}

# {{name}} will be replaced with $_SESSION['user_data']['kv']['name'], etc.
function parseText($text)
{
    $text = preg_replace_callback('/{{(.*?)}}/', function ($matches) {
        return $_SESSION['user_data']['kv'][$matches[1]];
    }, $text);
    return $text;
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
                $_SESSION['user_data']['kv'][$key] = $value;
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


# remove any options that have a "requires" key that is not met by one of our user_data keys
# "options": {
#    "goto-town-square": {
#        "text": "Go to the town square",
#        "action": "goto, town square"
#    },
#    "rush-to-help": {
#        "text": "Rush to help the town guard",
#        "action": "goto, bandit attack",
#        "requirements": {
#            "class": "warrior"
#        }
#    }
#}
# RETURNS: (assuming $_SESSION['user_data']['kv']['class'] != 'warrior')
# "options": {
#    "goto-town-square": {
#        "text": "Go to the town square",
#        "action": "goto, town square"
#    }
function validOptions($options)
{
    $validOptions = [];
    foreach ($options as $optionName => $option) {
        if (isset($option['requirements'])) {
            $requirements = $option['requirements'];
            $valid = true;
            foreach ($requirements as $key => $value) {
                if (getUserData($key) != $value) {
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
#session is started in autoimport.php
function getAllUserData()
{
    return $_SESSION['user_data'];
}

function getUserData($key)
{
    if (!isset($_SESSION['user_data'][$key])) {
        return null;
    }
    return $_SESSION['user_data'][$key];
}

function setUserData($key, $value)
{
    $_SESSION['user_data'][$key] = $value;
}
