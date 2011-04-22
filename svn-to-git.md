# Git to SVN migration

## Create a local svn repo

    mkdir /tmp/test-svn
    svnadmin create /tmp/test-svn

    cat /tmp/test-svn/hooks/pre-revprop-change
    #!/bin/sh
    exit 0;
    chmod +x /tmp/test-svn/hooks/pre-revprop-change

    svnsync init file:///tmp/test-svn http://progit-example.googlecode.com/svn/

See [Pro Git](http://progit.org/book/ch8-1.html).

## Sync my local svn repo with the remote one.

    svnsync sync file:///tmp/test-svn

## Clone a project out of the local svn repo into a git repo

    git svn clone http://my-project.googlecode.com/svn/ --authors-file=users.txt --no-metadata -s my_project


See [Pro Git](http://progit.org/book/ch8-2.html) for details about the authors file and more.
