default: check

# check types on any file change
check:
    find src/ tests/ | entr -s 'composer run lint'

# run tests in parallel
test:
    find src/ tests/ | entr -s 'composer run test'
