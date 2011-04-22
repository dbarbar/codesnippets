# Passwordless login

Add your public key to the authorized_keys file of the host you want to log in to.

    cat ~/.ssh/id_rsa.pub | ssh you@other-host 'cat - >> ~/.ssh/authorized_keys'

For CentOS, on the host check the permissions or else it won't work.

    chmod 700 ~/.ssh
    chmod 600 ~/.ssh/authorized_keys


See [this page](http://mah.everybody.org/docs/ssh#run-ssh-agent) and [the CentOS Wiki](http://wiki.centos.org/HowTos/Network/SecuringSSH).
