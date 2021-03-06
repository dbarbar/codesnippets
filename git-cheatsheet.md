Git Cheat Sheet
===============

## Revision Selection ##

Specify a revision by: full/partial SHA-1, branch name, tag name, caret parent, tilde spec, blob spec, relative spec, range.

### Caret parent ###

Second parent of default:

> `default^2`

o--x
    \
z----y <- master


master^ : z
master^2: x

## Branch Theory ##

In git, branches exist really more by definition than by structure. Every commit knows it parent or parents. Heads point to specific revisions. Branches exist by working up the backpointers from Heads.

Scott Chacon: "A branch is a lightweight movable pointer to a commit".

Creating and deleting branches is in the manual. Make lots of them.

### Inspecting Differences Between Branches ###

There are two 'dot operators': double and triple dot.

#### Double Dot ####

>	`ce0e4..e4272`
>	`[old]..[new]`

... "every commit reachable by e4272 that is not reachable by ce0e4".

>	`[old]..`

... assumes HEAD of the current branch as the RHS operand. Also works for `..[new]`:

>	`..origin/master`

... means "what does origin master have that I don't?"

#### Triple Dot ####

>	`c6...c4`

... finds the first common ancestor of c6 and c4, then returns the revisions between _that_ commit and c4.

## Log Tricks ##

Omitting branches from log:

>	`git log 08cb1 98ea2 ^c0890`

... means "show me everything reachable from 08cb1 and 98ea2, but not from c0890".

## Submodules Theory ##

> `git submodule add <repo> <path>`

Does the following:

* Clones _repo_ to _path_, checks out _repo_'s master.
* Adds the clone path to .gitmodules and adds .gitmodules to the containing project's index.
* Adds the submodule's current commit ID (i.e. the SHA-1 of HEAD) to the index (view with `git submodule status`).

>	`[/tmp/GitTest(master)]$ git submodule status`
>	`-43cc0d5e8f0c6f6c20953275bc29b2272ef69b97 FlickrKit`
>	`[/tmp/GitTest(master)]$ cd FlickrKit/ && git log -n 1 --pretty=oneline`
>	`43cc0d5e8f0c6f6c20953275bc29b2272ef69b97`

The superproject's index contains a SHA-1 for the submodule (`git ls-files --stage`), which is set from the sub's HEAD when the submodule is added.

>	`git submodule status`

* Shows the SHA-1 of the currently checked out commit in each submodule.
* Has a prefix of '-' if submodule is not initialised.
* Has a + prefix if the current SHA doesn't match the SHA that the superproject expects (i.e. there have been commits in the submodule)


Git knows where your subproject is at by:

1. The .gitmodules file tells git where the origin repo is, and where it should be checked out into the superproject.
2. The superproject's index holds the SHA-1 of the revision of the submodule that you want to have checked out.

You advance the checkout of your submodule by:

1. Adding the sub's path to your superproject (`git add SubModuleDir`)
2. Committing.

Git knows that your sub is dirty by comparing the SHA-1 in the superproject index with the contents of `SubModuleDir/.git/refs/heads/master`.

### Cloning a Project using Submodules ###

When you clone a project that uses submodules (and it's far from obvious how you would know if you have!), you have to run:

>	`git submodule init`
>	`git submodule update`

The first command registers the submodules, the second actually checks out the submodule at the specified revision.

### Branching Using Submodules ###

When you have two branches of your project that use different SHA-1s of the same submodule, you have to run `git submodule update` after switching branches.  The result of this is somewhat confusing at first glance.  What you will see is that:

* The submodule is switched to the SHA-1 that the superproject is locked to.
* The submodule's head is detached.

The detached head is initially confusing, but remember the theory of submodules: you're locking to _a specific SHA-1_ in a project. You're not locking to _a specific point on a named branch_. Git submodules knows essentially nothing about branches. All it knows about are commits.  You can get to commits by moving the submodule to the HEAD of a named branch, then locking to the current state, but remember that the superproject only knows:

* The submodule clone URL
* Where to put it in your superproject
* Which SHA-1 to update to when you execute `git submodule update`.

## Remote Tracking Branches ##

When the upstream has a new branch that you want to work on locally:

>	`git branch -r`

...will show you what the origin has that you don't.  If you want to work on one of these branches, you make a local branch:

>	`git branch --track MyBranch origin/TheFeature`

This gives you a branch called "MyBranch" which tracks "origin/TheFeature".


#### Sources ####

Mostly from Scott Chacon's git talks at Scotland on Rails '09 and Railsconf '09:

* http://en.oreilly.com/rails2009/public/schedule/detail/7367
* http://www.slideshare.net/railsconf/smacking-git-around-advanced-git-tricks
