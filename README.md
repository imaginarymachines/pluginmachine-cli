# Plugin Machine CLI


## Development

### Add Command

`php plugin-machine make:command HiRoy`

## Commands

### For Users
- List Plugins
    - `php plugin-machine plugins:all`
- Write pluginMachine.json for a plugin
    - `php plugin-machine plugin:config {pluginId}`
- Add a feature to current plugin
    - `php plugin-machine add`

### For Development

- Say Hi
    - `php plugin-machine hi {name?}`
- Sync rules
    - `php plugin-machine sync`
