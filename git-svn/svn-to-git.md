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

Then to fix the tags.

    cp -Rf .git/refs/remotes/tags/* .git/refs/tags/
    rm -Rf .git/refs/remotes/tags

This takes the references that were remote branches that started with tag/ and makes them real (lightweight) tags.

Next, move the rest of the references under refs/remotes to be local branches:

    cp -Rf .git/refs/remotes/* .git/refs/heads/
    rm -Rf .git/refs/remotes

Now all the old branches are real Git branches and all the old tags are real Git tags. The last thing to do is add your new Git server as a remote and push to it. Here is an example of adding your server as a remote:

    git remote add origin git@my-git-server:myrepository.git

Because you want all your branches and tags to go up, you can now run this:

    git push origin --all

See [Pro Git](http://progit.org/book/ch8-2.html) for details about the authors file and more.
