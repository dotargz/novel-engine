# Novel Engine

A web-based low-code choose-your-own-adventure engine with:

- dynamic variables
- choice requirements
- theming
- opinionated demo
- and more!

## Installation

To install the engine, simply clone the repository and start a PHP server in the root directory. The engine is written in PHP and requires a server to run.

### Linux (recommended)
To install PHP and the engine on a Linux machine, run the following commands in the terminal. The commands will install PHP and clone the repository into the default web directory. Make
```bash
sudo apt install php git
cd /var/www/html
git clone https://github.com/dotargz/novel-engine .
```

### Windows
Follow the instructions on the [official PHP website](https://www.php.net/manual/en/install.windows.tools.php) to install PHP. Then, after installing git from the [official website](https://git-scm.com/), run the following commands in the command prompt to clone the repository and start the server.

```bash
git clone https://github.com/dotargz/novel-engine
cd novel-engine
php -S localhost:80
```

## Usage

To customize the story, simply edit the `story.json` file. The file is a JSON object that contains the story's structure. The engine will read the file and display the story to the user.

Visit the wiki for instructions : https://github.com/dotargz/novel-engine/wiki/Story.json

## Roadmap

- [ ] Add per-page CSS
- [ ] Add markdown support
- [ ] Add good image support

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
