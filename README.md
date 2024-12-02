# ![Novel Engine (made by blueskye)](https://github.com/dotargz/novel-engine/assets/57809064/474ac615-8c1f-42c9-979d-d1faecee2f58)

A web-based low-code choose-your-own-adventure engine written in PHP with:
- dynamic variables
- choice requirements
- theming
- opinionated demo
- and more!

## Installation

To install the engine, clone the repository and start a PHP server in the directory created. 

### Linux 
(Recommended for servers) To install PHP and the engine on a Linux machine, run the following commands in the terminal. The commands will install PHP and clone the repository into the default web directory.
```bash
sudo apt install php git
cd /var/www/html
git clone https://github.com/dotargz/novel-engine .
```

### Windows
Follow the instructions on the [official PHP website](https://www.php.net/manual/en/install.windows.tools.php) to install PHP. Then, after [installing git](https://git-scm.com/), run the following commands in the command prompt to clone the repository and start the server.

```bash
git clone https://github.com/dotargz/novel-engine
cd novel-engine
php -S localhost:80
```

## Usage

To customize the story, edit the story structure contained in the `story.json` file. The engine reads that file to display the story as a website. To change the style or location of items, you can edit files in the public directory, compontents folder, or index.php. 

Visit the wiki for in-depth documentation and instructions: https://github.com/dotargz/novel-engine/wiki/

## Roadmap
View the [GitHub Project](https://github.com/users/dotargz/projects/2) with all open Roadmap issues and PRs.
- [ ] Add per-page CSS
- [ ] Add page transitions
- [ ] Add good image support

## Contributing

Pull requests are welcome! For major changes, please open an issue to discuss what you would like to change.
