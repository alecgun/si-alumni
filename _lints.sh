export DIFF_FILES=$(git diff --name-only --diff-filter=ACM $(git merge-base HEAD origin/main) | grep ".php")
if [[ ! -z $DIFF_FILES ]]
then
    echo "Checking ..." $DIFF_FILES
    ./vendor/bin/pint -v $DIFF_FILES
fi
