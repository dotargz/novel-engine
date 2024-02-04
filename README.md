# NovelEngine
Novel Engine is a web-based low-code choose-your-own-adventure engine with:
- dynamic characters
- choice requirements
- theming
- an opinionated out of the box style
- and more!

## Installation

To install the engine, simply clone the repository and start a PHP server in the root directory. The engine is written in PHP and requires a server to run.

```bash
git clone https://github.com/dotargz/novel-engine
cd novel-engine
php -S localhost:80
```

## Usage

To customize the story, simply edit the `story.json` file. The file is a JSON object that contains the story's structure. The engine will read the file and display the story to the user.

### Metadata Object

The metadata object contains axillary information about the story. This can include, but is not limited to, the title, author, and version of the story. It is currently not used by the engine directly, but it is recommended to include it for future compatibility.

```json
{
	"metadata": {
        "title": "My Story",
        "author": "John Doe",
        "version": "1.0"
    }
    ... rest of story.json ...
}
```

### Story Object

The story object the meat of the story.json file. It contains every page and every option that the user could take along their journey.

#### Pages

To define a page, simply create a new key-value pair in the story object. The key is the name of the page, and the value is an object that contains the page's heading, text, and options.

```json
{
    "story": {
        "pagename": {
            "heading": "Page Heading",
            "text": "Page Text",
            "options": {
                ... options ...
            }
        }
    }
}
```

#### Options

To define an option, simply create a new key-value pair in the options object. The key is the name of the option, and the value is an object that contains the option's text and action.
```json
{
	"options": {
		"optionname": {
			"text": "Text that will be displayed",
			"action": "set-KEY, VALUE; goto, pagename1"
		},
		"optionname2": {
			"text": "Text that will be displayed",
			"action": "set-KEY, VALUE; goto, pagename2"
		}
	}
}
```
#### Actions
Actions are written in a simple, human-readable format. They are separated by semicolons and are in the form of `action, argument`. The engine will read the actions and perform them in the order they are written.

The following actions are currently supported:
- `set-KEY, VALUE`: Sets a key-value pair in the story's state. This can be used to store the user's progress or to change the story's behavior.
- `goto, pagename`: Jumps to the specified page.
- `end`: Ends the story.

### Variables
To use variables in the story, simply use the `{{KEY}}` syntax. The engine will replace the variable with the value stored in the story's state.

```json
{
    "story": {
        "start": {
            "heading": "Welcome to the story",
            "text": "What is your race?",
            "options": {
                "human": {
                    "text": "Human",
                    "action": "set-race, human; goto, next1"
                },
            }
        },
        "next1": {
            "heading": "Next Page",
            "text": "You are a {{race}} now.",
            "options": {
                "next": {
                    "text": "end the story",
                    "action": "end"
                }
            }
        },
    }
}
```

## Roadmap
- [] Add per-page CSS
- [] Add markdown support
- [] Add good image support

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
