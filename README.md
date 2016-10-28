# vgm-vagrant-manager
A small php script to manage multiple vagrant boxes, works nicely coupled with xclip. it will generate the script command to switch between boxes.

## How to install
```
make
sudo make install
```
will do, you will have available the command 
```
$ vgm 
```

to remove it
```
sudo make uninstall
```

## Commands
### List

```
$ vgm ls
```
will output all the boxes actually in your system with their **state**
The box will be identified by name (the folder name)
```
1. Lamp: saved
2. Homestead: saved
3. Nodejs: saved
4. Mean: running
```

### Up

```
$ vgm u BOX_NAME
```
will generate the command to do a ```vagrant up``` inside the box folder

### Suspend

```
$ vgm s BOX_NAME
```
will generate the command to do a ```vagrant suspend``` inside the box folder

### Ssh

```
$ vgm ssh BOX_NAME
```
will generate the command to do a ```vagrant ssh``` inside the box folder

## Xclip Use Case
```
$ vgm u lamp | xclip
```
will copy on your clipboard the command to go into the folder, run the up command and come back.


## To do
- Print out an help on fail
- Fail nicely on up/suspend when the box is in the wrong status
- Allow to run the suspend/up task as a background task and returning just the stderr and stdout
- Implement other commands
